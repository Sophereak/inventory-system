<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👋 Welcome back, {{ auth()->user()->name }}!
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="bg-blue-50 text-blue-500 p-4 rounded-xl text-3xl">📦</div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Total Products</p>
                        <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Product::count() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="bg-green-50 text-green-500 p-4 rounded-xl text-3xl">🏷️</div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Total Categories</p>
                        <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Category::count() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                    <div class="bg-red-50 text-red-500 p-4 rounded-xl text-3xl">⚠️</div>
                    <div>
                        <p class="text-sm text-gray-400 font-medium">Low Stock Items</p>
                        <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Product::where('stock_qty', '<=', 5)->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-base font-semibold text-gray-700 mb-4">⚡ Quick Actions</h3>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('products.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
            + Add Product
        </a>
        <a href="{{ route('categories.create') }}"
           class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 transition">
            + Add Category
        </a>
        <a href="{{ route('stock-movements.create') }}"
           class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-purple-700 transition">
            + Record Movement
        </a>
    </div>
</div>

            {{-- Low Stock Warning --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-base font-semibold text-gray-700 mb-4">⚠️ Low Stock Products</h3>
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">SKU</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Stock</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse(\App\Models\Product::with('category')->where('stock_qty', '<=', 5)->get() as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $product->sku }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $product->category->name }}</td>
                            <td class="px-4 py-3">
                                @if($product->stock_qty == 0)
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">Out of Stock</span>
                                @else
                                    <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-semibold">{{ $product->stock_qty }} left</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('stock-movements.create') }}"
                                   class="text-blue-600 hover:underline text-xs">Restock →</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">
                                ✅ All products are well stocked!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Recent Movements --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-base font-semibold text-gray-700">🕒 Recent Stock Movements</h3>
                    <a href="{{ route('stock-movements.index') }}" class="text-blue-600 text-sm hover:underline">View all →</a>
                </div>
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Quantity</th>
                            <th class="px-4 py-3">By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse(\App\Models\StockMovement::with(['product','user'])->latest()->take(5)->get() as $movement)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-400">{{ $movement->date }}</td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $movement->product->name }}</td>
                            <td class="px-4 py-3">
                                @if($movement->type === 'in')
                                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">Stock In ▲</span>
                                @else
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">Stock Out ▼</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-600">{{ $movement->quantity }}</td>
                            <td class="px-4 py-3 text-gray-400">{{ $movement->user->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-gray-400">No movements yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>