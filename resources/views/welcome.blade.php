<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Healthcare Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <style>
        /* Optional: fade-in animation for hero section */
        .fade-in { animation: fadeIn 1s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px);} to { opacity: 1; transform: none; } }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-100 via-blue-200 to-blue-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-2xl mx-auto p-8 bg-white/90 rounded-2xl shadow-xl fade-in">
        <!-- Logo or Illustration -->
        <div class="flex justify-center mb-6">
            <svg class="w-16 h-16 text-blue-500" fill="none" viewBox="0 0 48 48" stroke="currentColor">
                <rect width="48" height="48" rx="12" fill="#3b82f6" opacity="0.1"/>
                <path stroke="#3b82f6" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                      d="M24 14v20M14 24h20"/>
            </svg>
        </div>

        <!-- Headline & Tagline -->
        <h1 class="text-4xl font-extrabold text-blue-700 mb-2">Healthcare Management, Simplified.</h1>
        <p class="text-lg text-blue-900 mb-6 font-medium">Empower your clinic or hospital with seamless patient care, scheduling, and data tracking-all in one place.</p>

        <!-- Features Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
            <div class="flex items-center space-x-3">
                <span class="bg-blue-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 4v16m8-8H4"/>
                    </svg>
                </span>
                <span class="text-gray-700 font-medium">Easy Patient Registration</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="bg-green-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                <span class="text-gray-700 font-medium">Doctor Scheduling & Appointments</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="bg-yellow-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3"/>
                        <circle cx="12" cy="12" r="10"/>
                    </svg>
                </span>
                <span class="text-gray-700 font-medium">Real-Time Device Data Entry</span>
            </div>
            <div class="flex items-center space-x-3">
                <span class="bg-pink-100 p-2 rounded-full">
                    <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z"/>
                        <path d="M12 17v2"/>
                    </svg>
                </span>
                <span class="text-gray-700 font-medium">Secure & Private Records</span>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
            <a href="{{ route('register') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-bold text-lg shadow transition">
                Get Started Free
            </a>
            <a href="{{ route('login') }}"
               class="bg-white border border-blue-600 text-blue-700 px-8 py-3 rounded-lg font-bold text-lg shadow hover:bg-blue-50 transition">
                Login
            </a>
        </div>

        <p class="mt-8 text-sm text-gray-400">Trusted by clinics and hospitals to deliver better healthcare, every day.</p>
    </div>
</body>
</html>
