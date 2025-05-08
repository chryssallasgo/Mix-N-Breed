<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mix N' Breed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-orange-50 font-sans">
    <nav class="bg-white shadow mb-6">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center font-bold text-lg">
                <img src="/images/doggielogo.png" alt="Mix N' Breed Logo" class="h-8 w-8 mr-2">
                Mix N’ Breed
            </a>
            <!-- Navigation Links -->
            <div class="flex items-center space-x-6">
                <a href="/about" class="text-gray-700 hover:text-orange-500 transition">About Us</a>
                <a href="/docs" class="text-gray-700 hover:text-orange-500 transition">Docs</a>
                <a href="/get-started" class="text-gray-700 hover:text-orange-500 transition">Get Started</a>
                
                <!-- Auth Buttons/Profile -->
                @guest
                    <a href="/login" class="px-4 py-2 rounded-md border border-orange-400 text-black font-semibold hover:bg-orange-50 transition">Login</a>
                    <a href="/register" class="ml-2 px-4 py-2 rounded-md bg-orange-400 text-white font-semibold hover:bg-orange-500 transition shadow">Sign Up</a>
                @endguest
    
                @auth
                <div class="relative group">
                    <button class="flex items-center focus:outline-none">
                        <span class="inline-block w-9 h-9 rounded-full bg-gray-300 overflow-hidden">
                            <img src="/images/dogprofile.jpg" alt="Doggy Profile">
                        </span>
                        <span class="ml-2 text-gray-700 font-semibold cursor-pointer">{{ Auth::user()->name }}</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 z-20
                        hidden group-hover:block group-focus-within:block">
                        <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="{{ route('dogprofiles.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">My Dogs</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">Logout</button>
                        </form>
                    </div>
                </div>                
                @endauth
            </div>
        </div>
    </nav>    
    <main>
        @yield('content')
    </main>
</body>
</html>
