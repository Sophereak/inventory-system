<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('stock-movements.index') }}" class="text-gray-400 hover:text-gray-600 transition">←</a>
            <h2 class="font-bold text-xl text-gray-800">🔄 Movement Detail</h2>
        </div>
    </x-slot>

    <div class="py-8 max-w-lg mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 space-y-5">

            <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                <span class="text-sm text-gray-400">Movement Type</span>
                @if($stockMovement->type === 'in')
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm font-semibold">▲ Stock In</span>
                @else
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm font-semibold">▼ Stock Out</span>
                @endif
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-400">Product</span>
                <span class="font-semibold text-gray-800">{{ $stockMovement->product->name }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-400">Quantity</span>
                <span class="font-bold text-2xl text-gray-800">{{ $stockMovement->quantity }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-400">Date</span>
                <span class="font-medium text-gray-700">{{ \Carbon\Carbon::parse($stockMovement->date)->format('d M Y') }}</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-sm text-gray-400">Note</span>
                <span class="text-gray-600 italic">{{ $stockMovement->note ?? '—' }}</span>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                <span class="text-sm text-gray-400">Recorded By</span>
                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">{{ $stockMovement->user->name }}</span>
            </div>

            <div class="pt-2">
                <a href="{{ route('stock-movements.index') }}"
                   class="bg-gray-100 text-gray-600 px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-200 transition inline-block">
                    ← Back to List
                </a>
            </div>
        </div>
    </div>
</x-app-layout>