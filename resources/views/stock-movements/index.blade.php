<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Stock Movements</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">All Stock Movements</h3>
                <a href="{{ route('stock-movements.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                    + Record Movement
                </a>
            </div>

            <table class="w-full text-sm text-left">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Product</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Note</th>
                        <th class="px-4 py-3">Recorded By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($movements as $movement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $movement->date }}</td>
                        <td class="px-4 py-3 font-medium">{{ $movement->product->name }}</td>
                        <td class="px-4 py-3">
                            @if($movement->type === 'in')
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">
                                    Stock In ▲
                                </span>
                            @else
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">
                                    Stock Out ▼
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $movement->quantity }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $movement->note ?? '-' }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $movement->user->name }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-4 text-center text-gray-400">No movements recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">{{ $movements->links() }}</div>
        </div>
    </div>
</x-app-layout>