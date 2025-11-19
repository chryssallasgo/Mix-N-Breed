<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mix N' Breed</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.globe.min.js"></script>
</head>

<body class="dark:bg-gray-950 bg-orange-50 font-sans">
<nav class="bg-white dark:bg-gray-900 shadow-lg sticky top-0 z-10">
    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo and brand -->
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="/images/doggielogo.png" alt="Mix N' Breed Logo" class="h-8 w-8 sm:h-10 sm:w-10">
                        <span class="ml-2 text-orange-500 font-bold text-lg sm:text-xl hidden xs:block">Mix N' Breed</span>
                        <span class="ml-2 text-orange-500 font-bold text-sm block xs:hidden">Mix N' Breed</span>
                    </a>
                </div>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex md:grow justify-end md:items-center md:space-x-8">
                <a href="/" class="text-gray-700 dark:text-white hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Home</a>
                <a href="/about" class="text-gray-700 dark:text-white hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">About</a>
                <a href="/docs" class="text-gray-700 dark:text-white hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Docs</a>
                <a href="{{ auth()->check() ? route('dogmatch.form') : route('login') }}" class="text-gray-700 dark:text-white hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Get Started</a>
                <a href="{{ route('marketplace.index') }}" class="text-gray-700 dark:text-white hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200">Marketplace</a>
            </div>

            <!-- Desktop Auth Buttons -->
            <div class="hidden md:flex md:items-center md:space-x-4">
                @guest
                    <a href="/login" class="text-gray-700 dark:text-white hover:text-orange-500 px-4 py-2 rounded-md text-sm font-medium border border-gray-300 hover:border-orange-500 transition-all duration-200">
                        Login
                    </a>
                    <a href="/register" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200 shadow-sm">
                        Sign Up
                    </a>
                @endguest

                @auth
                    <div class="relative">
                        <button 
                            id="desktop-user-menu-button"
                            class="flex items-center space-x-2 text-gray-700 dark:text-white hover:text-orange-500 focus:outline-none focus:text-orange-500 transition-colors duration-200 px-2 py-1 rounded-md hover:bg-orange-50 dark:hover:bg-gray-950"
                            aria-expanded="false"
                            aria-haspopup="true">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                    alt="{{ Auth::user()->name }}" 
                                    class="h-8 w-8 rounded-full object-cover border-2 border-orange-300">
                            @else
                                <div class="h-8 w-8 rounded-full bg-orange-200 flex items-center justify-center border-2 border-orange-300">
                                    <span class="text-sm font-bold text-orange-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                            @endif
                            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <!-- dropdown_menu -->
                        <div 
                            id="desktop-user-dropdown"
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-900 rounded-md shadow-lg py-1 border border-gray-200 opacity-0 invisible transform scale-95 transition-all duration-200 ease-out z-50"
                            role="menu">
                            <a href="{{ route('userprofile.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-white dark:hover:bg-gray-950 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200" role="menuitem">
                                Your Profile
                            </a>
                            <a href="{{ route('dogprofiles.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-white dark:hover:bg-gray-950 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200" role="menuitem">
                                My Dogs
                            </a>
                            <a href="{{ route('userprofile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-white dark:hover:bg-gray-950 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200" role="menuitem">
                                Account Settings
                            </a>
                            <hr class="my-1 border-gray-200">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-400 dark:hover:bg-gray-950 hover:bg-orange-50 hover:text-orange-500 transition-colors duration-200" role="menuitem">
                                    Sign out
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth

                <!-- admin_login -->
                <a href="{{ route('admin.login') }}" class="text-gray-400 hover:text-orange-500 p-2 rounded-md transition-colors duration-200" title="Admin Login">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </a>
            </div>

            <!-- mobile_section -->
            <div class="md:hidden flex items-center">
                <button type="button" id="mobile-menu-button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-orange-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-orange-500 transition-all duration-200" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--hamburger_icon -->
                    <svg class="block h-6 w-6" id="hamburger-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-6 w-6" id="close-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu (hidden by default) -->
    <div class="md:hidden hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 bg-white dark:bg-gray-900 border-t dark:border-gray-450 border-gray-200">
            <!-- Mobile Navigation Links -->
            <a href="/" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-500 dark:text-white hover:bg-orange-50 transition-all duration-200">Home</a>
            <a href="/about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-500 dark:text-white hover:bg-orange-50 transition-all duration-200">About</a>
            <a href="/docs" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-500 dark:text-white hover:bg-orange-50 transition-all duration-200">Docs</a>
            <a href="{{ auth()->check() ? route('dogmatch.form') : route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-orange-500 dark:text-white hover:bg-orange-50 transition-all duration-200">Get Started</a>
        </div>

        @guest
            <!-- Mobile Auth Section -->
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4 space-y-3 flex-col">
                    <a href="/login" class="w-full text-center bg-white border border-orange-500 text-orange-500 hover:bg-orange-50 px-4 py-2 rounded-md text-sm font-medium transition-all duration-200">
                        Login
                    </a>
                    <a href="/register" class="w-full text-center bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                        Sign Up
                    </a>
                </div>
            </div>
        @endguest

        @auth
            <!-- Mobile User Section -->
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                            @if(Auth::user()->profile_picture)
                                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                    alt="{{ Auth::user()->name }}" 
                                    class="h-8 w-8 rounded-full object-cover border-2 border-orange-300">
                            @else
                                <div class="h-8 w-8 rounded-full bg-orange-200 flex items-center justify-center border-2 border-orange-300">
                                    <span class="text-sm font-bold text-orange-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                </div>
                            @endif
                    <div class="ml-3">
                        <div class="text-base font-medium dark:text-white text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium dark:text-gray-300 text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ url('/userprofile') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200">Your Profile</a>
                    <a href="{{ route('dogprofiles.index') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200">My Dogs</a>
                    <a href="{{ route('userprofile.edit') }}" class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        @endauth

        <!-- Mobile Admin Link -->
        <div class="border-t border-gray-200 pt-2 pb-3">
            <a href="{{ route('admin.login') }}" class="flex items-center px-4 py-2 text-base font-medium text-gray-500 hover:text-orange-500 hover:bg-orange-50 transition-all duration-200">
                <svg class="h-5 w-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                Admin Login
            </a>
        </div>
    </div>
</nav>

<!-- hover/click functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isTouchDevice = () => {
        return (('ontouchstart' in window) ||
               (navigator.maxTouchPoints > 0) ||
               (navigator.msMaxTouchPoints > 0));
    };

    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isOpen = !mobileMenu.classList.contains('hidden');
            
            if (isOpen) {
                closeMobileMenu();
            } else {
                openMobileMenu();
            }
        });
    }

    function openMobileMenu() {
        mobileMenu.classList.remove('hidden');
        hamburgerIcon.classList.add('hidden');
        closeIcon.classList.remove('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'true');
    }

    function closeMobileMenu() {
        mobileMenu.classList.add('hidden');
        hamburgerIcon.classList.remove('hidden');
        closeIcon.classList.add('hidden');
        mobileMenuButton.setAttribute('aria-expanded', 'false');
    }

    // dropdown functionality 
    const desktopUserButton = document.getElementById('desktop-user-menu-button');
    const desktopDropdown = document.getElementById('desktop-user-dropdown');
    const dropdownArrow = document.getElementById('desktop-dropdown-arrow');

    if (desktopUserButton && desktopDropdown) {
        let isDropdownOpen = false;
        let hoverTimeout;

        function showDropdown() {
            if (hoverTimeout) clearTimeout(hoverTimeout);
            isDropdownOpen = true;
            desktopDropdown.classList.remove('opacity-0', 'invisible', 'scale-95');
            desktopDropdown.classList.add('opacity-100', 'visible', 'scale-100');
            dropdownArrow.style.transform = 'rotate(180deg)';
            desktopUserButton.setAttribute('aria-expanded', 'true');
        }

        // Hide dropdown function
        function hideDropdown() {
            if (hoverTimeout) clearTimeout(hoverTimeout);
            hoverTimeout = setTimeout(() => {
                isDropdownOpen = false;
                desktopDropdown.classList.remove('opacity-100', 'visible', 'scale-100');
                desktopDropdown.classList.add('opacity-0', 'invisible', 'scale-95');
                dropdownArrow.style.transform = 'rotate(0deg)';
                desktopUserButton.setAttribute('aria-expanded', 'false');
            }, 100); 
        }

        if (isTouchDevice()) {
            desktopUserButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                if (isDropdownOpen) {
                    hideDropdown();
                } else {
                    showDropdown();
                }
            });
            document.addEventListener('click', function(e) {
                if (!desktopUserButton.contains(e.target) && !desktopDropdown.contains(e.target)) {
                    hideDropdown();
                }
            });
        } else {
            desktopUserButton.addEventListener('mouseenter', showDropdown);
            desktopDropdown.addEventListener('mouseenter', showDropdown);
            
            desktopUserButton.addEventListener('mouseleave', hideDropdown);
            desktopDropdown.addEventListener('mouseleave', hideDropdown);

            desktopUserButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (isDropdownOpen) {
                    hideDropdown();
                } else {
                    showDropdown();
                }
            });
        }
    }

    document.addEventListener('click', function(event) {
        if (mobileMenuButton && mobileMenu && 
            !mobileMenuButton.contains(event.target) && 
            !mobileMenu.contains(event.target)) {
            closeMobileMenu();
        }
    });


    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { 
            closeMobileMenu();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (!mobileMenu.classList.contains('hidden')) {
                closeMobileMenu();
            }
            if (isDropdownOpen) {
                hideDropdown();
            }
        }
    });
});
</script>

    <main>
        @yield('content')
            <!-- Footer content contains information such as, contains logo, quick links, resources, and contact info -->
    <footer class="dark:bg-gray-900 bg-orange-100 border-t-2 dark:border-gray-900 border-orange-100">
            <div class="max-w-6xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="flex flex-col items-center md:items-start">
                    <img src="{{ asset('images/doggielogo.png') }}" alt="Mix N' Breed Logo" class="w-14 h-14 mb-2">
                    <span class="font-bold text-orange-700 text-xl mb-2">Mix N' Breed</span>
                    <p class="text-gray-700 dark:text-gray-400 text-sm mb-2 text-center md:text-left">
                        Helping you discover the magic of mixed breeds.<br>
                        Your guide to responsible and fun dog breeding! 🐾
                    </p>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Quick Links</h3>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-400 text-sm">
                        <li><a href="{{ url('/') }}" class="hover:text-orange-600">Home</a></li>
                        <li><a href="{{ route('dogprofiles.index') }}" class="hover:text-orange-600">Your Dogs</a></li>
                        <li><a href="{{ route('dogmatch.form') }}" class="hover:text-orange-600">Mix Breeds</a></li>
                        <li><a href="{{ route('contactus') }}" class="hover:text-orange-600">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Resources</h3>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-400 text-sm">
                        <li><a href="#" class="hover:text-orange-600">Dog Breeding Guide</a></li>
                        <li><a href="#" class="hover:text-orange-600">Breeder Tips</a></li>
                        <li><a href="{{ url('/docs') }}" class="hover:text-orange-600">FAQs</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-orange-700 mb-3">Connect</h3>
                    <ul class="space-y-2 text-gray-700 dark:text-gray-400 text-sm">
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
            <div class="dark:bg-gray-700 bg-orange-400 text-center text-gray-100 text-xs py-4 border-t border-orange-300 dark:border-gray-700">
                &copy; {{ date('Y') }} Mix N' Breed. All rights reserved.
            </div>
        </footer>
    </main>
    <script>
  feather.replace();
</script>
</body>
</html>
