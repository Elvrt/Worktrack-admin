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
                @empty($report)
                    <div class="flex items-center justify-center p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg"
                        role="alert">
                        <h5 class="font-semibold mr-1">Error!</h5>
                        <span>The data you are looking for is not found</span>
                    </div>
                    <a href="{{ route('report.index') }}"
                        class="mt-2 inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-700 hover:bg-red-800 rounded-lg shadow-sm focus:ring-4 focus:ring-primary-300">
                        Back
                    </a>
                @else
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                                <label for="employee_id" class="block mb-2 text-sm font-medium text-gray-900">Employee Name</label>
                                <select name="employee_id" id="employee_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    disabled>
                                    <option selected disabled>Choose a employee name</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->employee_id}}" {{ $report->absence->employee->employee_id == $employee->employee_id ? "selected" : "" }}>
                                            {{$employee->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="absence_date" class="block mb-2 text-sm font-medium text-gray-900">Absence Date</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input name="absence_date" id="absence_date"
                                        value="{{ \Carbon\Carbon::parse($report->absence->absence_date)->format('M/d/Y') }}"
                                        id="datepicker-orientation" datepicker datepicker-orientation="bottom right"
                                        type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                        placeholder="Select date" autocomplete="off" disabled>
                                </div>
                                @error('absence_date')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="clock_in" class="block mb-2 text-sm font-medium text-gray-900">Clock In</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input name="clock_in" id="clock_in"
                                        value="{{ old('clock_in', $report->absence->clock_in) }}" type="time"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        autocomplete="off" disabled />
                                </div>
                                @error('clock_in')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="clock_out" class="block mb-2 text-sm font-medium text-gray-900">Clock Out</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <input name="clock_out" id="clock_out"
                                        value="{{ old('clock_out', $report->absence->clock_out) }}" type="time"
                                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                        autocomplete="off" disabled />
                                </div>
                                @error('clock_out')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <p
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                    @if ($report->absence->status === 'ontime')
                                        <span class="inline-block w-2 h-2 mr-2 bg-green-500 rounded-full"></span>
                                    @elseif ($report->absence->status === 'late')
                                        <span class="inline-block w-2 h-2 mr-2 bg-red-500 rounded-full"></span>
                                    @else
                                        <span class="inline-block w-2 h-2 mr-2 bg-gray-500 rounded-full"></span>
                                    @endif
                                    {{ $report->absence->status }}
                                </p>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <label for="activity_title"
                                    class="block mb-2 text-sm font-medium text-gray-900">Activity Title</label>
                                <input type="text" name="activity_title" id="activity_title"
                                    value="{{ $report->activity_title }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                    placeholder="Enter activity title" autocomplete="off" disabled>
                                @error('activity_title')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-span-6">
                                <label for="activity_description"
                                    class="block mb-2 text-sm font-medium text-gray-900">Activity Description</label>
                                <textarea name="activity_description" id="activity_description" rows="3"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Enter activity description" disabled>{{ $report->activity_description }}</textarea>
                                @error('activity_description')
                                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="items-center p-6 border-t border-gray-200 rounded-b">
                        <a href="{{ route('report.index') }}"
                            class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Back</a>
                    </div>
                @endempty
            </div>
        </div>
    </div>
</div>
@endsection