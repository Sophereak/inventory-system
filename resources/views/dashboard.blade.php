<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Summary Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                    <div class="bg-blue-100 text-blue-600 p-3 rounded-full text-2xl">📦</div>
                    <div>
                        <p class="text-sm text-gray-500">Total Products</p>
                        <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Product::count() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                    <div class="bg-green-100 text-green-600 p-3 rounded-full text-2xl">🏷️</div>
                    <div>
                        <p class="text-sm text-gray-500">Total Categories</p>
                        <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Category::count() }}</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow p-6 flex items-center gap-4">
                    <div class="bg-red-100 text-red-600 p-3 rounded-full text-2xl">⚠️</div>
                    <div>
                        <p class="text-sm text-gray-500">Low Stock Items</p>
                        <p class="text-2xl font-bold text-gray-800">{{ \App\Models\Product::where('stock_qty', '<=', 5)->count() }}</p>
                    </div>
                </div>
            </div>

            {{-- Low Stock Warning Table --}}
            <div class="bg-white rounded-xl shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Low Stock Products</h3>
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">SKU</th>
                            <th class="px-4 py-3">Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse(\App\Models\Product::where('stock_qty', '<=', 5)->get() as $product)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $product->sku }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ $product->stock_qty }} left
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-4 py-4 text-center text-gray-400">All products are well stocked ✅</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>