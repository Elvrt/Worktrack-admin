<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            @if (session()->has('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" id="success-alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session()->has('loginError'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" id="errors-alert">
                    <span class="block sm:inline">{{ session('loginError') }}</span>
                </div>
            @endif

            <div class="bg-white shadow-lg rounded-lg p-8">
                <h2 class="text-center text-2xl font-semibold mb-6">Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mt-4">
                        <label for="username" class="block text-gray-700">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            autofocus required>
                    </div>
                    @error('username')
                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                    <div class="mt-4">
                        <label for="password" class="block text-gray-700">Password</label>
                        <input type="password" id="password" name="password" value="{{ old('password') }}"
                            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    @error('password')
                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="mr-2">
                            <label for="remember" class="text-sm text-gray-700">Remember Me</label>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Login
                    </button>
                </form>
            </div>
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
</body>
</html>