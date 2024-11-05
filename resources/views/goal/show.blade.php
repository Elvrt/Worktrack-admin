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
                @empty($goal)
                    <div class="flex items-center justify-center p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"
                        role="alert">
                        <h5 class="font-semibold mr-1">Error!</h5>
                        <span>The data you are looking for is not found</span>
                    </div>
                    <a href="{{ route('goal.index') }}"
                        class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg shadow-sm focus:ring-4 focus:ring-primary-300">
                        Back
                    </a>
                @else
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
                                    <input name="goal_date" id="goal_date"
                                        value="{{ \Carbon\Carbon::parse($goal->goal_date)->format('M/d/Y') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select date" disabled>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="project_title" class="block mb-2 text-sm font-medium text-gray-900">Project
                                    Title</label>
                                <input type="text" name="project_title" id="project_title"
                                    value="{{ $goal->project_title }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    placeholder="Enter project title" disabled>
                            </div>
                            <div class="col-span-6">
                                <label for="project_description"
                                    class="block mb-2 text-sm font-medium text-gray-900">Project Description</label>
                                <textarea name="project_description" id="project_description" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Enter project description"
                                    disabled>{{ $goal->project_description }}</textarea>
                            </div>
                            <div class="col-span-6">
                                <label for="employee_ids" class="block mb-2 text-sm font-medium text-gray-900">Employee
                                    Names</label>
                                <!-- Selected Employees Display -->
                                <div id="selectedEmployees" class="mt-2 mb-2">
                                    @foreach($goal->employees as $employee)
                                        <span
                                            class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 mb-2 px-2.5 py-0.5 rounded inline-block">
                                            {{ $employee->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <a href="{{ route('goal.index') }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
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
    </script>
@endpush
@endsection