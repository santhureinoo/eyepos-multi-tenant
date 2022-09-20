<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('customers.create') }}">
                        @csrf
                        <label class="form-label" for="first_name">Firstname</label>
                        <input name="first_name" id="first_name" type="text" class="form-control @error('first_name') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="last_name">Surname</label>
                        <input name="last_name" id="last_name" type="text" class="form-control @error('last_name') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="email">Email address</label>
                        <input name="email" id="email" type="email" class="form-control @error('email') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="phone">Phone</label>
                        <input name="phone" id="phone" type="text" class="form-control @error('phone') is-invalid @else is-valid @enderror">

                        <label class="form-label" for="dob">Date of Birth</label>
                        <input name="dob" id="dob" type="date">

                        <label class="form-label" for="gender">Gender</label>
                        <select name="gender" id="gender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                        <label class="form-label" for="company_name">Company</label>
                        <input name="company_name" id="company_name" type="text" class="form-control @error('company_name') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="occupation">Occupation</label>
                        <input name="occupation" id="occupation" type="text" class="form-control @error('occupation') is-invalid @else is-valid @enderror">
                        <label class="form-label" for="insurance">Insurance</label>
                        <input name="insurance" id="insurance" type="text" class="form-control @error('insurance') is-invalid @else is-valid @enderror">

                        <button class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

