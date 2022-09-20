<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('inventory.create') }}">
                        @csrf
                        @method('put')

                        <label class="form-label" for="category_id">Category</label>
                        <select name="category_id" id="category_id">
                            @foreach($categories as $key => $value)
                                <option value="{{ $key }}">{{ ucfirst($value->name) }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="type">Type</label>
                        <input name="type" id="type" type="text" class="form-control @error('type') is-invalid @else is-valid @enderror">

                        <label class="form-label" for="supplier_id">Suppliers</label>
                        <select name="supplier_id" id="supplier_id">
                            @foreach($suppliers as $key => $value)
                                <option value="{{ $key }}">{{ ucfirst($value->name) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="brand_id">Brand</label>
                        <select name="brand_id" id="brand_id">
                            @foreach($brands as $key => $value)
                                <option value="{{ $key }}">{{ ucfirst($value->name) }}</option>
                            @endforeach
                        </select>

                        <label class="form-label" for="sub_brand">Sub Brand</label>
                        <input name="sub_brand" id="sub_brand" type="text" class="form-control @error('sub_brand') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="description">Description</label>
                        <input name="description" id="description" type="text" class="form-control @error('description') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="prescription">Prescription</label>
                        <input name="prescription" id="prescription" type="text" class="form-control @error('prescription') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input name="quantity" id="quantity" type="number" class="form-control @error('quantity') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="size">Size</label>
                        <input name="size" id="size" type="text" class="form-control @error('size') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="material">Material</label>
                        <input name="material" id="material" type="text" class="form-control @error('material') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="color_frame">Frame Color</label>
                        <input name="color_frame" id="color_frame" type="text" class="form-control @error('color_frame') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="color_lens">Lens Color</label>
                        <input name="color_lens" id="color_lens" type="text" class="form-control @error('color_lens') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="shape">Shape</label>
                        <input name="shape" id="shape" type="text" class="form-control @error('shape') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="gender">Gender</label>
                        <input name="gender" id="gender" type="text" class="form-control @error('gender') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="price_cost">Cost Price</label>
                        <input name="price_cost" id="price_cost" type="text" class="form-control @error('price_cost') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="price_list">List Price</label>
                        <input name="price_list" id="price_list" type="text" class="form-control @error('price_list') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="price_selling">Selling Price</label>
                        <input name="price_selling" id="price_selling" type="text" class="form-control @error('price_selling') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="consignment">Consignment</label>
                        <input name="consignment" id="consignment" type="text" class="form-control @error('consignment') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="purchase_at">Purchased At</label>
                        <input name="purchase_at" id="purchase_at" type="date" class="form-control @error('purchase_at') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="soldout_at">Sold Out</label>
                        <input name="soldout_at" id="soldout_at" type="text" class="form-control @error('soldout_at') is-invalid @else is-valid @enderror">

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

