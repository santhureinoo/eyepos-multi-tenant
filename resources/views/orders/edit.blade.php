<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                        @csrf
                        @method('put')

                        <label class="form-label" for="customer_id">Customer</label>
                        <select name="customer_id" id="customer_id">
                            @foreach($customers as $key => $value)
                                <option value="{{ $value->id }}" @if($value->id === $order->customer_id) selected @endif>{{ ucfirst($value->email) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="inventory_id">Inventory Item</label>
                        <select name="inventory_id" id="inventory_id">
                            @foreach($inventories as $key => $value)
                                <option value="{{ $value->id }}" @if($value->id === $order->category_id) selected @endif>{{ ucfirst($value->id) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="value">Value</label>
                        <input name="value" id="value" type="text" value="{{ old('value', $order->value) }}" class="form-control @error('value') is-invalid @else is-valid @enderror">

                        <label class="form-label" for="gst">GST</label>
                        <input name="gst" id="gst" type="text" value="{{ old('gst', $order->gst) }}" class="form-control @error('gst') is-invalid @else is-valid @enderror">

                        <button class="btn btn-primary">Edit Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

