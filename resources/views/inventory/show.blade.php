<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-7 lg:px-7">
            <a href="{{ route('inventory') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ $inventory['type'] }}: {{ $inventory['price_cost'] }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
