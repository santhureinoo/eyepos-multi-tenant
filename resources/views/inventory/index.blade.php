<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventory') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-7 lg:px-7">
            <a href="{{ route('inventory.create') }}" class="btn btn-primary">Add Inventory</a>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                        <tr class="text-left">
                            <th>Category</th>
                            <th>Type</th>
                            <th>Supplier</th>
                            <th>Brand</th>
                            <th>Subbrand</th>
                            {{--                            <th>Description</th>--}}
                            {{--                            <th>Prescription</th>--}}
                            {{--                            <th>Quantity</th>--}}
                            {{--                            <th>Size</th>--}}
                            {{--                            <th>Material</th>--}}
                            {{--                            <th>Frame Color</th>--}}
                            {{--                            <th>Lens Color</th>--}}
                            {{--                            <th>Shape</th>--}}
                            {{--                            <th>Gender</th>--}}
                            {{--                            <th>Cost Price</th>--}}
                            {{--                            <th>List Price</th>--}}
                            {{--                            <th>Selling Price</th>--}}
                            {{--                            <th>Consignment</th>--}}
                            {{--                            <th>Purchased</th>--}}
                            {{--                            <th>Soldout</th>--}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->category->name }}</td>
                                <td>{{ $inventory->type }}</td>
                                <td>{{ $inventory->supplier->name }}</td>
                                <td>{{ $inventory->brand->name }}</td>
                                <td>{{ $inventory->sub_brand }}</td>
                                {{--                               <td>{{ $inventory->description }}</td>--}}
                                {{--                               <td>{{ $inventory->prescription }}</td>--}}
                                {{--                               <td>{{ $inventory->quantity }}</td>--}}
                                {{--                               <td>{{ $inventory->size }}</td>--}}
                                {{--                               <td>{{ $inventory->material }}</td>--}}
                                {{--                               <td>{{ $inventory->color_frame }}</td>--}}
                                {{--                               <td>{{ $inventory->color_lens }}</td>--}}
                                {{--                               <td>{{ $inventory->shape }}</td>--}}
                                {{--                               <td>{{ $inventory->gender }}</td>--}}
                                {{--                               <td>{{ $inventory->price_cost }}</td>--}}
                                {{--                               <td>{{ $inventory->price_list }}</td>--}}
                                {{--                               <td>{{ $inventory->price_selling }}</td>--}}
                                {{--                               <td>{{ $inventory->consignment }}</td>--}}
                                {{--                               <td>{{ $inventory->purchase_at }}</td>--}}
                                {{--                               <td>{{ $inventory->soldout_at }}</td>--}}
                                <td>
                                    <a href="{{ route('inventory.show', $inventory->id)}}" class="link-primary"><i class="fas fa-eye pr-2"></i></a>
                                    <a href="{{ route('inventory.edit', $inventory->id)}}" class="link-primary"><i class="fas fa-edit pr-2"></i></a>
                                    <a href="{{ route('inventory.destroy', $inventory->id)}}" class="link-danger"><i class="fas fa-trash pr-2"></i></a>
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
