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
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
            <h2 class="text-center text-2xl font-semibold mb-6">Login</h2>

            <!-- Login Form -->
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-700">Remember Me</label>
                    </div>
                    <a href="#" class="text-sm text-blue-500 hover:underline">Forgot Password?</a>
                </div>

                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Login
                </button>
            </form>

        </div>
    </div>

</body>
</html>
