@extends('layouts.template')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">

        <!-- Breadcrumb -->
        @include('layouts.breadcrumb')
        <!-- /.Breadcrumb -->

        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <a href="{{ route('permission.create') }}"
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
        </div>
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
                                Start Date
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                End Date
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Reason
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($permissions as $permission)
                            <tr class="hover:bg-gray-100">
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $permission->employee->name }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ \Carbon\Carbon::parse($permission->start_date)->format('d M Y') }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ \Carbon\Carbon::parse($permission->end_date)->format('d M Y') }}
                                </td>
                                <td
                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $permission->reason }}
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('permission.show', $permission->time_off_id) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </a>
                                    <form id="approve-form-{{ $permission->time_off_id }}" method="POST"
                                        action="{{ route('permission.update', $permission->time_off_id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="approved">
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-lime-600 hover:bg-lime-800 focus:ring-4 focus:ring-lime-300">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form id="reject-form-{{ $permission->time_off_id }}" method="POST"
                                        action="{{ route('permission.update', $permission->time_off_id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16"
                                                height="16" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="max-w-sm p-4 overflow-hidden text-center font-normal text-gray-500 truncate xl:max-w-xs">
                                    No permissions found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection