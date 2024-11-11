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
                <form action="{{ route('permission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                    Name</label>
                                <select name="employee_id" id="employee_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required>
                                    <option selected disabled>Choose a employee name</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->employee_id}}"
                                            {{old('employee_id') == $employee->employee_id ? "selected" : ""}}>
                                            {{$employee->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="letter" class="block mb-2 text-sm font-medium text-gray-900">Letter</label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                                    name="letter" id="letter" type="file" accept="image/*" onchange="previewImage(event)">
                                <p class="mt-1 text-sm text-gray-500">JPG, PNG, or JPEG (MAX. 2MB).</p>
                                @error('letter')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900">Start
                                    Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="start_date" id="start_date" value="{{ old('start_date') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select start date" required>
                                </div>
                                @error('start_date')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900">End
                                    Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="end_date" id="end_date" value="{{ old('end_date') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select end date" required>
                                </div>
                                @error('end_date')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="reason" class="block mb-2 text-sm font-medium text-gray-900">Reason</label>
                                <textarea name="reason" id="reason" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Provide additional reasons for permission here">{{ old('reason') }}</textarea>
                                @error('reason')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center0"
                            type="submit">Add</button>
                        <a href="{{ route('permission.index') }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Letter Preview -->
<div id="letterModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="relative w-full max-w-md p-4 bg-white rounded-lg shadow-lg">
            <button type="button" onclick="closeModal()"
                class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
                &#10005;
            </button>
            <h2 class="mb-4 text-lg font-medium text-gray-900">Letter Preview</h2>
            <div class="overflow-y-auto max-h-96 rounded-lg">
                <img id="letterPreview" src="#" alt="Letter Preview" class="w-full max-w-xs object-cover mx-auto">
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function previewImage(event) {
            const image = document.getElementById('letterPreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    image.src = e.target.result;
                    openModal();
                };
                reader.readAsDataURL(file);
            }
        }

        function openModal() {
            document.getElementById('letterModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('letterModal').classList.add('hidden');
        }
    </script>
@endpush
@endsection