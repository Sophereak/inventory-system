<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Movement Detail</h2>
    </x-slot>

    <div class="py-8 max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow p-6">

            <div class="mb-4">
                <p class="text-sm text-gray-500">Product</p>
                <p class="font-semibold text-gray-800">{{ $stockMovement->product->name }}</p>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Type</p>
                @if($stockMovement->type === 'in')
                    <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-semibold">Stock In ▲</span>
                @else
                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-semibold">Stock Out ▼</span>
                @endif
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Quantity</p>
                <p class="font-semibold text-gray-800">{{ $stockMovement->quantity }}</p>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Date</p>
                <p class="font-semibold text-gray-800">{{ $stockMovement->date }}</p>
            </div>

            <div class="mb-4">
                <p class="text-sm text-gray-500">Note</p>
                <p class="font-semibold text-gray-800">{{ $stockMovement->note ?? '-' }}</p>
            </div>

            <div class="mb-6">
                <p class="text-sm text-gray-500">Recorded By</p>
                <p class="font-semibold text-gray-800">{{ $stockMovement->user->name }}</p>
            </div>

            <a href="{{ route('stock-movements.index') }}"
               class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200">
                ← Back to List
            </a>
        </div>
    </div>
</x-app-layout> 