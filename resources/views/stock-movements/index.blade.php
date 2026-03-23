<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-xl text-gray-800">🔄 Stock Movements</h2>
            <a href="{{ route('stock-movements.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                + Record Movement
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
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Product</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Note</th>
                        <th class="px-6 py-4 text-xs font-semibold text-gray-500 uppercase">Recorded By</th>
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
                            <div class="text-4xl mb-2">🔄</div>
                            <p>No movements recorded yet.</p>
                            <a href="{{ route('stock-movements.create') }}" class="text-blue-500 hover:underline text-sm mt-1 inline-block">Record your first movement</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t border-gray-50">{{ $movements->links() }}</div>
        </div>
    </div>
</x-app-layout>