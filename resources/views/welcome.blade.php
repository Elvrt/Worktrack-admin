<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body class="bg-blue-50">
    <div class="flex items-center justify-center min-h-screen">
        <div class="text-center bg-white p-10 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800">Welcome to Our Application WorkTrack</h1>
            <p class="mt-4 text-gray-600">Please log in to access the full features.</p>
            <a href="{{ route('login') }}" class="mt-6 inline-block px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition duration-200">
                Go to Login
            </a>
        </div>
    </div>
</body>
</html>