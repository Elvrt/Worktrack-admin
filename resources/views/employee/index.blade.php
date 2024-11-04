@extends('layouts.template')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">

        <!-- Breadcrumb -->
        @include('layouts.breadcrumb')
        <!-- /.Breadcrumb -->

        <div class="sm:flex">
            <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                <a href="{{ route('employee.create') }}"
                    class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-amber-600 hover:bg-amber-800 focus:ring-4 focus:ring-amber-300 sm:w-auto">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Add Employee
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
                                Employee Number
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Name
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Position
                            </th>
                            <th scope="col" class="p-4 text-xs font-medium text-left text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-gray-100">
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $employee->employee_number }}
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $employee->name }}
                                </td>
                                <td class="p-4 text-base font-medium text-gray-900 whitespace-nowrap overflow-hidden truncate">
                                    {{ $employee->user->role->position }}
                                </td>
                                <td class="p-4 space-x-2 whitespace-nowrap">
                                    <a href="{{ route('employee.edit', $employee->employee_id) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-lime-600 hover:bg-lime-800 focus:ring-4 focus:ring-lime-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('employee.show', $employee->employee_id) }}"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                            <path
                                                d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                        </svg>
                                    </a>
                                    <button type="button" onclick="openModal({{ $employee->employee_id }})"
                                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <!-- Modal Konfirmasi Delete -->
                                    <div id="delete-modal"
                                        class="fixed inset-0 z-50 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
                                        <div class="bg-white rounded-lg p-6 space-y-4 shadow-lg w-full max-w-md">
                                            <div class="p-6 pt-0 text-center">
                                                <svg class="w-16 h-16 mx-auto text-red-600" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <h3 class="mt-5 mb-6 text-lg text-gray-500">Are you sure you want to
                                                    delete this ?</h3>
                                                <div class="flex justify-center space-x-4">
                                                    <form id="delete-form" action=""
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-white bg-primary-600 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center">
                                                            Yes, I'm sure
                                                        </button>
                                                    </form>
                                                    <button type="button" onclick="closeModal()"
                                                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center">
                                                        No, cancel
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    class="max-w-sm p-4 overflow-hidden text-center font-normal text-gray-500 truncate xl:max-w-xs">
                                    No employees found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function openModal(employeeId) {
            document.getElementById('delete-form').action = "{{ route('employee.destroy', '') }}/" + employeeId;

            document.getElementById('delete-modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('delete-modal').classList.add('hidden');
        }
    </script>
@endpush
@endsection