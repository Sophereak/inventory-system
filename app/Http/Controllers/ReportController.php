<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Stock levels report
        $products = Product::with('category')
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10);

        // Stock movements report
        $movements = StockMovement::with(['product', 'user'])
            ->when($request->product_id, function ($query) use ($request) {
                $query->where('product_id', $request->product_id);
            })
            ->when($request->type, function ($query) use ($request) {
                $query->where('type', $request->type);
            })
            ->when($request->date_from, function ($query) use ($request) {
                $query->whereDate('date', '>=', $request->date_from);
            })
            ->when($request->date_to, function ($query) use ($request) {
                $query->whereDate('date', '<=', $request->date_to);
            })
            ->latest()
            ->paginate(10);

        // Summary numbers
        $totalIn = StockMovement::where('type', 'in')
            ->when($request->product_id, fn($q) => $q->where('product_id', $request->product_id))
            ->when($request->date_from, fn($q) => $q->whereDate('date', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->whereDate('date', '<=', $request->date_to))
            ->sum('quantity');

        $totalOut = StockMovement::where('type', 'out')
            ->when($request->product_id, fn($q) => $q->where('product_id', $request->product_id))
            ->when($request->date_from, fn($q) => $q->whereDate('date', '>=', $request->date_from))
            ->when($request->date_to, fn($q) => $q->whereDate('date', '<=', $request->date_to))
            ->sum('quantity');

        $allProducts = Product::all();

        return view('reports.index', compact(
            'products', 'movements', 'totalIn', 'totalOut', 'allProducts'
        ));
    }
}