<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Worktrack Admin') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-gray-50">

    <!-- Navbar -->
    @include('layouts.header')
    <!-- /.navbar -->
    
    <div class="flex pt-12 overflow-hidden bg-gray-50">

        <aside id="sidebar"
            class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width"
            aria-label="Sidebar">
            <div
                class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">

                <!-- Sidebar -->
                @include('layouts.sidebar')
                <!-- /.sidebar -->

                <!-- Footer -->
                @include('layouts.footer')
                <!-- /.Footer -->

            </div>
        </aside>

        <div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64">
            <main>
    
                @yield('content')

            </main>

        </div>

    </div>

    <script>
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            let errorAlert = document.getElementById('errors-alert');

            if (successAlert) {
                successAlert.style.display = 'none';
            }

            if (errorAlert) {
                errorAlert.style.display = 'none';
            }
        }, 5000); // 5-second delay
    </script>
    @stack('js')

    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="https://flowbite-admin-dashboard.vercel.app//app.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.2/datepicker.min.js"></script>
</body>

</html>