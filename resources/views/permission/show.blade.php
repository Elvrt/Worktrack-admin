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
                @empty($permission)
                    <div class="flex items-center justify-center p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"
                        role="alert">
                        <h5 class="font-semibold mr-1">Error!</h5>
                        <span>The data you are looking for is not found</span>
                    </div>
                    <a href="{{ route('permission.index') }}"
                        class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg shadow-sm focus:ring-4 focus:ring-primary-300">
                        Back
                    </a>
                @else
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                    Name</label>
                                <select name="employee_id" id="employee_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled>
                                    <option selected disabled>Choose a employee name</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->employee_id }}"
                                            {{ $permission->employee->employee_id == $employee->employee_id ? "selected" : "" }}>
                                            {{ $employee->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="letter" class="block mb-2 text-sm font-medium text-gray-900">Letter</label>
                                <button type="button" onclick="openModal('{{ $permission->letter }}')" class="block w-full text-start text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2.5">
                                    View Letter
                                </button>
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
                                    <input name="start_date" id="start_date" value="{{ \Carbon\Carbon::parse($permission->start_date)->format('M/d/Y') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select start date" disabled>
                                </div>
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
                                    <input name="end_date" id="end_date" value="{{ \Carbon\Carbon::parse($permission->end_date)->format('M/d/Y') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select end date" disabled>
                                </div>
                            </div>
                            <div class="col-span-6">
                                <label for="reason" class="block mb-2 text-sm font-medium text-gray-900">Reason</label>
                                <textarea name="reason" id="reason" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Provide additional reasons for permission here" disabled>{{ $permission->reason }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <a href="{{ route('permission.index') }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>

<!-- Modal for Letter Preview -->
<div id="letterModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-50">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="relative w-full max-w-md p-4 bg-white rounded-lg shadow-lg">
            <button type="button" onclick="closeModal()" class="absolute top-3 right-3 text-gray-600 hover:text-gray-900">
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
        function openModal(src) {
            const image = document.getElementById('letterPreview');
            image.src = src;
            document.getElementById('letterModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('letterModal').classList.add('hidden');
        }
    </script>
@endpush
@endsection