<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Healthcare Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-50 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-md w-full">
        <h1 class="text-3xl font-bold mb-4 text-blue-700">Welcome to the Healthcare Management System</h1>
        <p class="mb-6 text-gray-700">A modern platform for managing patients, doctors, appointments, and device data.</p>
        <a href="{{ route('login') }}"
           class="inline-block bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
            Login
        </a>
        <a href="{{ route('register') }}"
           class="inline-block ml-4 bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700 transition">
            Register
        </a>
    </div>
</body>
</html>
