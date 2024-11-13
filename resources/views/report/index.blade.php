@extends('layouts.template')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">

        <!-- Breadcrumb -->
        @include('layouts.breadcrumb')
        <!-- /.Breadcrumb -->

        <!-- <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <a href=""
                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 sm:w-auto">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Add Permission
                </a>
            </div>
        </div> -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-center text-green-700 p-2 mt-3 rounded-lg relative"
                id="success-alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-center text-red-700 p-2 mt-3 rounded-lg relative"
                id="errors-alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    </div>
</div>
<div class="p-4 flex flex-col">
    <div class="overflow-x-auto">
        <div class="inline-block min-w-full align-middle">
            <div class="overflow-hidden shadow">
                <table id="data-table" class="min-w-full divide-y divide-gray-200 table-fixed">
                    <thead class="bg-gray-100">
                        <tr>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Nama
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Date
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Activity Title
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Activity Description
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($reports as $report)
                            <tr class="hover:bg-gray-100">
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $report->absence->employee->name }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ \Carbon\Carbon::parse($report->absence->absence_date)->format('d M Y') }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $report->activity_title }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $report->activity_description }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="max-w-sm p-4 overflow-hidden text-center font-normal text-gray-500 truncate xl:max-w-xs">
                                    No reports found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection