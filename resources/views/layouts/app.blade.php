<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mix N' Breed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
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
                <!-- Admin Login Icon Link -->
                <a href="{{ route('admin.login') }}" title="Admin Login" class="text-gray-700 hover:text-orange-600 ml-4">
                    <i class="fas fa-lock fa-lg"></i>
                    <!-- Or use SVG icon inline -->

                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c.828 0 1.5.672 1.5 1.5S12.828 14 12 14s-1.5-.672-1.5-1.5S11.172 11 12 11z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v4m-6 4v6a6 6 0 0012 0v-6m-6 0V7a3 3 0 016 0v4" />
                    </svg>

                </a>
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
            <!-- Footer -->
    <footer class="bg-orange-100 border-t-2 border-orange-200 mt-16">
            <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & About -->
                <div class="flex flex-col items-center md:items-start">
                    <img src="{{ asset('images/doggielogo.png') }}" alt="Mix N' Breed Logo" class="w-14 h-14 mb-2">
                    <span class="font-bold text-orange-700 text-xl mb-2">Mix N' Breed</span>
                    <p class="text-gray-700 text-sm mb-2 text-center md:text-left">
                        Helping you discover the magic of mixed breeds.<br>
                        Your guide to responsible and fun dog breeding! 🐾
                    </p>
                </div>
                <!-- Quick Links -->
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-orange-600">Home</a></li>
                        <li><a href="{{ route('dogprofiles.index') }}" class="hover:text-orange-600">Your Dogs</a></li>
                        <li><a href="{{ route('dogmatch.form') }}" class="hover:text-orange-600">Mix Breeds</a></li>
                        <li><a href="#" class="hover:text-orange-600">Health Tips</a></li>
                        <li><a href="#" class="hover:text-orange-600">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Resources -->
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Resources</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li><a href="#" class="hover:text-orange-600">Dog Breeding Guide</a></li>
                        <li><a href="#" class="hover:text-orange-600">Compatibility Checker</a></li>
                        <li><a href="#" class="hover:text-orange-600">Breeder Tips</a></li>
                        <li><a href="#" class="hover:text-orange-600">FAQs</a></li>
                    </ul>
                </div>
                <!-- Contact & Social -->
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Connect</h3>
                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>
                            <a href="mailto:info@mixnbreed.com" class="hover:text-orange-600 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm2 4v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2"></path></svg>
                                info@mixnbreed.com
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-600 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="20" x="2" y="2" rx="5" /><circle cx="12" cy="12" r="3.5" /><circle cx="17.5" cy="6.5" r="1.5" /></svg>
                                Instagram
                            </a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-600 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-orange-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22.54 6.42a8.94 8.94 0 01-2.54.7 4.48 4.48 0 001.98-2.48 8.94 8.94 0 01-2.83 1.08 4.48 4.48 0 00-7.64 4.08A12.72 12.72 0 013 4.89a4.48 4.48 0 001.39 5.98 4.48 4.48 0 01-2.03-.56v.06a4.48 4.48 0 003.6 4.4 4.48 4.48 0 01-2.02.08 4.48 4.48 0 004.18 3.11A9 9 0 012 19.54a12.72 12.72 0 006.88 2.02c8.26 0 12.78-6.84 12.78-12.78 0-.19 0-.38-.01-.57A9.22 9.22 0 0024 4.59a8.94 8.94 0 01-2.54.7z"></path></svg>
                                Twitter
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-center text-gray-500 text-xs py-4 border-t border-orange-200">
                &copy; {{ date('Y') }} Mix N' Breed. All rights reserved.
            </div>
        </footer>
    </main>
</body>
</html>
