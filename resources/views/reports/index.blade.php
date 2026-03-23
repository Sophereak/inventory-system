<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">📊 Reports</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="bg-green-50 text-green-500 p-4 rounded-xl text-3xl">▲</div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Total Stock In</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalIn }}</p>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex items-center gap-4 hover:shadow-md transition">
                <div class="bg-red-50 text-red-500 p-4 rounded-xl text-3xl">▼</div>
                <div>
                    <p class="text-sm text-gray-400 font-medium">Total Stock Out</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalOut }}</p>
                </div>
            </div>
        </div>

        {{-- Filter Form --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-base font-semibold text-gray-700 mb-4">🔍 Filter Movements</h3>
            <form method="GET" action="{{ route('reports.index') }}">
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Product</label>
                        <select name="product_id"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">All Products</option>
                            @foreach($allProducts as $product)
                                <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Type</label>
                        <select name="type"
                                class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="">All Types</option>
                            <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>▲ Stock In</option>
                            <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>▼ Stock Out</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Date From</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-2">Date To</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                </div>
                <div class="mt-4 flex gap-3">
                    <button type="submit"
                            class="bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                        Apply Filter
                    </button>
                    <a href="{{ route('reports.index') }}"
                       class="bg-gray-100 text-gray-600 px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Movements Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="text-base font-semibold text-gray-700">🕒 Stock Movement History</h3>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Note</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($movements as $movement)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 text-gray-500">{{ \Carbon\Carbon::parse($movement->date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $movement->product->name }}</td>
                        <td class="px-6 py-4">
                            @if($movement->type === 'in')
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">▲ Stock In</span>
                            @else
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">▼ Stock Out</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-700">{{ $movement->quantity }}</td>
                        <td class="px-6 py-4 text-gray-400 italic">{{ $movement->note ?? '—' }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-xs">
                                {{ $movement->user->name }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-2">📭</div>
                            <p>No movements found for the selected filters.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50">{{ $movements->links() }}</div>
        </div>

        {{-- Current Stock Levels --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h3 class="text-base font-semibold text-gray-700">📦 Current Stock Levels</h3>
                <form method="GET" action="{{ route('reports.index') }}">
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Search product..."
                           class="border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                </form>
            </div>
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">SKU</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Stock</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs font-mono">
                                {{ $product->sku }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-gray-700">{{ $product->stock_qty }}</td>
                        <td class="px-6 py-4">
                            @if($product->stock_qty == 0)
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">Out of Stock</span>
                            @elseif($product->stock_qty <= 5)
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-semibold">⚠️ Low Stock</span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">✅ In Stock</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-2">📭</div>
                            <p>No products found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50">{{ $products->links() }}</div>
        </div>

    </div>
</x-app-layout>