<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Products</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">All Products</h3>
                <a href="{{ route('products.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    + Add Product
                </a>
            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">SKU</th>
                        <th class="px-4 py-3">Category</th>
                        <th class="px-4 py-3">Price</th>
                        <th class="px-4 py-3">Stock</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $product->sku }}</td>
                        <td class="px-4 py-3">{{ $product->category->name }}</td>
                        <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                        <td class="px-4 py-3">
                            @if($product->stock_qty <= 5)
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ $product->stock_qty }}
                                </span>
                            @else
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ $product->stock_qty }}
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('products.edit', $product) }}"
                               class="text-yellow-600 hover:underline text-xs">Edit</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                  onsubmit="return confirm('Delete this product?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-400">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">{{ $products->links() }}</div>
        </div>
    </div>
</x-app-layout>