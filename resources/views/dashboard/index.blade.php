@extends('layouts.template')

@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5">
    <div class="w-full mb-1">

        <!-- Breadcrumb -->
        @include('layouts.breadcrumb')
        <!-- /.Breadcrumb -->

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
                Dashboard Coming Soon
            </div>
        </div>
    </div>
</div>
@endsection