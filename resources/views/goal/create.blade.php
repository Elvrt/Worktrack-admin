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
                <form action="{{ route('goal.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="goal_date" class="block mb-2 text-sm font-medium text-gray-900">Goal
                                    Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="goal_date" id="goal_date" value="{{ old('goal_date') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select date" required>
                                </div>
                                @error('goal_date')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="project_title" class="block mb-2 text-sm font-medium text-gray-900">Project
                                    Title</label>
                                <input type="text" name="project_title" id="project_title"
                                    value="{{ old('project_title') }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    placeholder="Enter project title" required>
                                @error('project_title')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="project_description"
                                    class="block mb-2 text-sm font-medium text-gray-900">Project Description</label>
                                <textarea name="project_description" id="project_description" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Enter project description">{{ old('project_description') }}</textarea>
                                @error('project_description')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="employee_ids" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                    Names</label>
                                <!-- Selected Employees Display -->
                                <div id="selectedEmployees" class="mt-2 mb-2"></div>
                                <button type="button" onclick="openEmployeeModal()"
                                    class="bg-yellow-500 text-white rounded-lg px-4 py-2 hover:bg-yellow-600">
                                    Select Employees
                                </button>
                            </div>
                            <!-- Employee Modal -->
                            <div id="employeeModal"
                                class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                <div class="bg-white rounded-lg p-6 space-y-4 shadow-lg w-full max-w-lg">
                                    <div class="text-center">
                                        <h3 class="text-lg font-medium text-gray-900">Select Employees</h3>
                                        <div class="mt-4">
                                            <input type="text" id="employeeSearch" onkeyup="searchEmployees()"
                                                placeholder="Search employee..."
                                                class="w-full p-2 border border-gray-300 rounded-lg">
                                        </div>
                                    </div>
                                    <div class="mt-4 max-h-60 overflow-y-auto space-y-2">
                                        <!-- Employee List with Checkboxes -->
                                        @foreach($employees as $employee)
                                            <div class="flex items-center">
                                                <input type="checkbox" name="employee_id[]"
                                                    value="{{ $employee->employee_id }}" class="employee-checkbox mr-2">
                                                <label class="text-gray-700">{{ $employee->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="flex justify-center space-x-4 mt-6">
                                        <button type="button" onclick="confirmEmployeeSelection()"
                                            class="text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-base inline-flex items-center px-4 py-2">
                                            Confirm
                                        </button>
                                        <button type="button" onclick="closeEmployeeModal()"
                                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-4 py-2">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <button
                            class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center0"
                            type="submit">Add</button>
                        <a href="{{ route('goal.index') }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function openEmployeeModal() {
            document.getElementById('employeeModal').classList.remove('hidden');
        }

        function closeEmployeeModal() {
            document.getElementById('employeeModal').classList.add('hidden');
        }

        function confirmEmployeeSelection() {
            const checkboxes = document.querySelectorAll('.employee-checkbox');
            const selectedEmployees = [];
            const selectedEmployeesDisplay = document.getElementById('selectedEmployees');

            // Clear previous selections
            selectedEmployeesDisplay.innerHTML = '';

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedEmployees.push(checkbox.nextElementSibling.textContent);
                }
            });

            // Display selected employees as tags
            selectedEmployees.forEach(name => {
                const tag = document.createElement('span');
                tag.classList.add('bg-yellow-100', 'text-yellow-800', 'text-sm', 'font-medium', 'mr-2', 'mb-2', 'px-2.5', 'py-0.5', 'rounded', 'inline-block');
                tag.textContent = name;
                selectedEmployeesDisplay.appendChild(tag);
            });

            closeEmployeeModal();
        }

        function searchEmployees() {
            const input = document.getElementById('employeeSearch').value.toLowerCase();
            const employeeLabels = document.querySelectorAll('.employee-checkbox + label');

            employeeLabels.forEach(label => {
                const parentDiv = label.parentElement;
                if (label.textContent.toLowerCase().includes(input)) {
                    parentDiv.classList.remove('hidden');
                } else {
                    parentDiv.classList.add('hidden');
                }
            });
        }
    </script>
@endpush
@endsection