<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-7 lg:px-7">
            <a href="{{ route('customers.create') }}" class="btn btn-primary">Add Customer</a>
        </div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                        <tr class="text-left">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            {{--                            <th>Gender</th>--}}
                            {{--                            <th>DoB</th>--}}
                            {{--                            <th>Company</th>--}}
                            {{--                            <th>Occupation</th>--}}
                            {{--                            <th>Insurance</th>--}}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                {{--                                <td>{{ $customer->gender }}</td>--}}
                                {{--                                <td>{{ $customer->dob }}</td>--}}
                                {{--                                <td>{{ $customer->company_name }}</td>--}}
                                {{--                                <td>{{ $customer->occupation }}</td>--}}
                                {{--                                <td>{{ $customer->insurance }}</td>--}}
                                <td>
                                    <a href="{{ route('customers.show', $customer->id) }}" class="link-primary"><i class="fas fa-eye pr-2"></i></a>
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="link-primary"><i class="fas fa-edit pr-2"></i></a>
                                    <a href="{{ route('customers.destroy', $customer->id) }}" class="link-danger"><i class="fas fa-trash"></i></a>
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
