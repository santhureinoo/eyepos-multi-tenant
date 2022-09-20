<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('orders.create') }}">
                        @csrf
                        @method('put')

                        <label class="form-label" for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id">
                            @foreach($customers as $key => $value)
                                <option value="{{ $value->id }}">{{ ucfirst($value->email) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="inventory_id">Inventory Item</label>
                        <select name="inventory_id" id="inventory_id">
                            @foreach($inventories as $key => $value)
                                <option value="{{ $value->id }}">{{ ucfirst($value->id) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="value">Value</label>
                        <input name="value" id="value" type="text" class="form-control @error('value') is-invalid @else is-valid @enderror">

                        <label class="form-label" for="gst">GST</label>
                        <input name="gst" id="gst" type="text" class="form-control @error('gst') is-invalid @else is-valid @enderror">

                        <button class="btn btn-primary">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

