@extends('layouts.template')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">

        <!-- Breadcrumb -->
        @include('layouts.breadcrumb')
        <!-- /.Breadcrumb -->

    </div>
</div>
<div class="p-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                @empty($employee)
                    <div class="flex items-center justify-center p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"
                        role="alert">
                        <h5 class="font-semibold mr-1">Error!</h5>
                        <span>The data you are looking for is not found</span>
                    </div>
                    <a href="{{ route('employee.index') }}"
                        class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg shadow-sm focus:ring-4 focus:ring-primary-300">
                        Back
                    </a>
                @else
                    <form action="{{ route('employee.update', $employee->employee_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="employee_number"
                                        class="block mb-2 text-sm font-medium text-gray-900">Employee Number</label>
                                    <input type="text" name="employee_number" id="employee_number"
                                        value="{{ old('employee_number', $employee->employee_number) }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter employee number" autocomplete="off" required>
                                    @error('employee_number')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $employee->name) }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter name" autocomplete="off" required>
                                    @error('name')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="date_of_birth" class="block mb-2 text-sm font-medium text-gray-900">Date of
                                        Birth</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                            </svg>
                                        </div>
                                        <input name="date_of_birth" id="date_of_birth"
                                            value="{{ old('date_of_birth', \Carbon\Carbon::parse($employee->date_of_birth)->format('M/d/Y')) }}"
                                            id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                            type="text"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                            placeholder="Select date" autocomplete="off" required>
                                    </div>
                                    @error('date_of_birth')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone_number" class="block mb-2 text-sm font-medium text-gray-900">Phone
                                        Number</label>
                                    <input type="text" name="phone_number" id="phone_number"
                                        value="{{ old('phone_number', $employee->phone_number) }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter phone number" autocomplete="off" required>
                                    @error('phone_number')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6">
                                    <label for="address"
                                        class="block mb-2 text-sm font-medium text-gray-900">Address</label>
                                    <textarea name="address" id="address" rows="3"
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Enter address">{{ old('address', $employee->address) }}</textarea>
                                    @error('address')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="role_id"
                                        class="block mb-2 text-sm font-medium text-gray-900">Position</label>
                                    <select name="role_id" id="role_id"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        required>
                                        <option disabled>Choose a position</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->role_id }}" {{ old('role_id', $employee->user->role->role_id) == $role->role_id ? "selected" : "" }}>
                                                {{ $role->position }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="username"
                                        class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                    <input type="text" name="username" id="username"
                                        value="{{ old('username', $employee->user->username) }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter username" autocomplete="off" required>
                                    @error('username')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                                    <input type="password" name="password" id="password" value="{{ old('password') }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter password" autocomplete="off">
                                    @error('password')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="password_confirm"
                                        class="block mb-2 text-sm font-medium text-gray-900">Password Confirm</label>
                                    <input type="password" name="password_confirm" id="password_confirm"
                                        value="{{ old('password_confirm') }}"
                                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter password confirm" autocomplete="off">
                                    @error('password_confirm')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="profile"
                                        class="block mb-2 text-sm font-medium text-gray-900">Profile</label>
                                    <input
                                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                        name="profile" id="profile" type="file" accept="image/*"
                                        onchange="previewImage(event)">
                                    <p class="mt-1 text-sm text-gray-500">JPG, PNG, or JPEG (MAX. 2MB).</p>
                                    @error('profile')
                                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                    @enderror

                                    <!-- Display cropped image preview here -->
                                    <div class="mt-3">
                                        <img id="profilePreview" src="{{ $employee->profile }}" alt=""
                                            class="w-32 h-32 rounded-full object-cover bg-red-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="items-center p-6 border-t border-gray-200 rounded-b">
                            <button
                                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                type="submit">Confirm</button>
                            <a href="{{ route('employee.index') }}"
                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                        </div>
                    </form>
                @endempty
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function previewImage(event) {
            const image = document.getElementById('profilePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endpush
@endsection