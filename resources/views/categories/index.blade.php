<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">🏷️ Categories</h2>
            <a href="{{ route('categories.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                + Add Category
            </a>
        </div>
    </x-slot>

    <div class="py-8 max-w-4xl mx-auto sm:px-6 lg:px-8">

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
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Products</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($categories as $category)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-400">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded-full text-xs font-semibold">
                                {{ $category->products->count() }} products
                            </span>
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('categories.edit', $category) }}"
                               class="bg-yellow-50 text-yellow-600 border border-yellow-200 px-3 py-1 rounded-lg text-xs hover:bg-yellow-100 transition">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                  onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-50 text-red-600 border border-red-200 px-3 py-1 rounded-lg text-xs hover:bg-red-100 transition">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                            <div class="text-4xl mb-2">🏷️</div>
                            <p>No categories yet.</p>
                            <a href="{{ route('categories.create') }}" class="text-blue-500 hover:underline text-sm mt-1 inline-block">Add your first category</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50">{{ $categories->links() }}</div>
        </div>
    </div>
</x-app-layout>