<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">📦 Products</h2>
            <a href="{{ route('products.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                + Add Product
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">#</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">SKU</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Stock</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $product->name }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-500 px-2 py-1 rounded text-xs font-mono">
                                {{ $product->sku }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-700 font-medium">${{ number_format($product->price, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($product->stock_qty == 0)
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">Out of Stock</span>
                            @elseif($product->stock_qty <= 5)
                                <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded-full text-xs font-semibold">⚠️ {{ $product->stock_qty }}</span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">✅ {{ $product->stock_qty }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('products.edit', $product) }}"
                               class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-3 py-1 rounded-lg text-xs hover:bg-yellow-100 transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs hover:bg-red-100 transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-2">📦</div>
                            <p>No products yet.</p>
                            <a href="{{ route('products.create') }}" class="text-blue-500 hover:underline text-sm mt-1 inline-block">Add your first product</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>