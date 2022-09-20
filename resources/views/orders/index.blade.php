<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-7 lg:px-7">
            <a href="{{ route('orders.create') }}" class="btn btn-primary">New Order</a>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                        <tr class="text-left">
                            <th>Customer</th>
                            <th>InventoryId</th>
                            <th>Value</th>
                            <th>GST</th>
                            {{--                            <th>Description</th>--}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td><a href="/customers/{{ $order->customer->id }}" class="link-primary">{{ $order->customer->email }}</a></td>
                                <td><a href="/inventory/{{ $order->inventory->id }}" class="link-primary">{{ $order->inventory->id }}</a></td>
                                <td>{{ $order->value }}</td>
                                <td>{{ $order->gst }}</td>
                                {{--                                <td>{{ $order->description }}</td>--}}
                                <td>
                                    <a href="{{ route('orders.show', $order->id)}}" class="link-primary"><i class="fas fa-eye pr-2"></i></a>
                                    <a href="{{ route('orders.edit', $order->id)}}" class="link-primary"><i class="fas fa-edit pr-2"></i></a>
                                    <a href="{{ route('orders.destroy', $order->id)}}" class="link-danger"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
