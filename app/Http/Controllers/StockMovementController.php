<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use App\Models\Product;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])
            ->latest()
            ->paginate(10);
        return view('stock-movements.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock-movements.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,out',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string',
            'date'       => 'required|date',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check stock if moving out
        if ($request->type === 'out' && $product->stock_qty < $request->quantity) {
            return back()->withErrors([
                'quantity' => 'Not enough stock. Available: ' . $product->stock_qty
            ])->withInput();
        }

        // Update stock quantity
        if ($request->type === 'in') {
            $product->increment('stock_qty', $request->quantity);
        } else {
            $product->decrement('stock_qty', $request->quantity);
        }

        // Record the movement
        StockMovement::create([
            'product_id' => $request->product_id,
            'user_id'    => auth()->id(),
            'type'       => $request->type,
            'quantity'   => $request->quantity,
            'note'       => $request->note,
            'date'       => $request->date,
        ]);

        return redirect()->route('stock-movements.index')
            ->with('success', 'Stock movement recorded successfully.');
    }

    public function show(StockMovement $stockMovement)
    {
        return view('stock-movements.show', compact('stockMovement'));
    }
}
