<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">All Categories</h3>
                <a href="{{ route('categories.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    + Add Category
                </a>
            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Products</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $category->products->count() }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="text-yellow-600 hover:underline text-xs">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-4 text-center text-gray-400">No categories found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">{{ $categories->links() }}</div>
        </div>
    </div>
</x-app-layout>