<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mix N' Breed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-lg">Mix N’ Breed</a>
            <!-- Navigation Links -->
        <div class="flex items-center space-x-6">
            <a href="/about" class="text-gray-700 hover:text-orange-500 transition">About Us</a>
            <a href="/docs" class="text-gray-700 hover:text-orange-500 transition">Docs</a>
            <a href="/get-started" class="text-gray-700 hover:text-orange-500 transition">Get Started</a>
            
            <!-- Auth Buttons -->
            <a href="/login" class="px-4 py-2 rounded-md border border-gray-400 text-gray-900 font-semibold hover:bg-gray-50 transition">Login</a>
            <a href="/register" class="ml-2 px-4 py-2 rounded-md bg-gray-900 text-white font-semibold hover:bg-gray-500 transition shadow">Sign Up</a>
        </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
</body>
</html>
