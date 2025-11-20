@extends('layouts.app')

@section('content')

    <section class="pl-5 pr-5 relative bg-linear-to-r from-amber-500  to-orange-600 py-10 overflow-hidden"> <!-- or image bg-[url('/public/images/gr.jpg')] -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
            <div class="space-y-6">
                <h1 class="text-4xl md:text-5xl font-bold text-white leading-tight">
                    You know your dog.<br>
                    We know how to mix them.
                </h1>
                <p class="text-gray-200 text-xl leading-relaxed">
                    Breed matching tailored to your needs.<br>
                    Get a preview of mixed breed combinations with our AI technology.
                </p>
                {{-- start button --}}
                <div class="pt-4">
                    <a href="{{ auth()->check() ? route('dogmatch.form') : route('login') }}" 
                       class="inline-flex items-center px-8 py-3 text-lg font-semibold text-orange-500 bg-white rounded-lg hover:bg-orange-100 transition-colors duration-300 shadow-lg hover:shadow-xl">
                        Get Started
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
                {{-- end button --}}
            </div>
            <!-- featured Image -->
            <div class="relative">
                <img src="{{ asset('images/dogprofile.jpg') }}" alt="Featured Dog" 
                     class="rounded-2xl shadow-2xl w-full h-[500px] object-cover">
                <div class="absolute inset-0 rounded-2xl bg-linear-to-tr from-orange-500/20 to-transparent"></div>
            </div>
        </div>
    </section>
    <div class="bg-orange-50 dark:bg-gray-800 pt-10 justify-center flex items-center">
        <div class="max-w-1xl mx-auto px-4 py-4">
        <!-- statistics section -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-lg p-8 mb-16">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="flex items-center space-x-4 p-4 hover:bg-orange-50 rounded-xl transition-colors duration-300">
                    <div class="bg-orange-100 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold dark:text-white text-gray-800">{{ $totalDogProfiles ?? 0 }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Dogs Registered</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 p-4 hover:bg-blue-50 rounded-xl transition-colors duration-300">
                    <div class="bg-blue-100 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold dark:text-white text-gray-800">{{ $matchCount ?? 0 }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Matches Made</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 p-4 hover:bg-green-50 rounded-xl transition-colors duration-300">
                    <div class="bg-green-100 p-3 rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <div>
                        <div class="text-3xl font-bold dark:text-white text-gray-800">{{ $tipCount ?? 0 }}</div>
                        <div class="text-gray-600 dark:text-gray-400">Health Tips</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- How It Works Section -->
    <section class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4 text-gray-800 dark:text-white">How It Works</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12 dark:text-gray-400">Our three-step process makes breed mixing simple and informative</p>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-t-4 border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="bg-orange-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                        <i data-feather="upload" class="text-amber-500 w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 dark:text-white">Upload Your Dogs</h3>
                    <p class="text-gray-600 dark:text-gray-400">Create profiles for your dogs by uploading photos and entering their details.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-t-4 border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="bg-orange-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                        <i data-feather="git-merge" class="text-amber-500 w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 dark:text-white">Mix & Match</h3>
                    <p class="text-gray-600 dark:text-gray-400">Select two breeds to see potential outcomes and compatibility factors.</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm border-t-4 border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="bg-orange-100 w-14 h-14 rounded-full flex items-center justify-center mb-4">
                        <i data-feather="bar-chart-2" class="text-amber-500 w-6 h-6"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 dark:text-white">Get Insights</h3>
                    <p class="text-gray-600 dark:text-gray-400">Receive detailed reports on health, temperament, and care requirements.</p>
                </div>
            </div>
        </div>
    </section>
  <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4 dark:text-white text-gray-800">Popular Breed Mixes</h2>
            <p class="text-center text-gray-600 dark:text-gray-400 max-w-2xl mx-auto mb-12">Discover some of the most beloved combinations from our community</p>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- breed_cards -->
                <div class="bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-sm border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="relative h-48">
                        <img src="{{ asset('images/goldendoodle.jpg') }}" alt="Goldendoodle" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black to-transparent p-4">
                            <h3 class="text-white font-bold text-xl">Goldendoodle</h3>
                            <p class="text-white text-opacity-80">Golden Retriever + Poodle</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-amber-600">Hypoallergenic</span>
                            <span class="text-sm dark:text-gray-400 text-gray-500">Medium Size</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2">
                            <div class="h-2 bg-amber-600 rounded-full" style="width: 85%"></div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">85% compatibility score</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-sm border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="relative h-48">
                        <img src="{{ asset('images/pomsky.jpg') }}" alt="Pomsky" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black to-transparent p-4">
                            <h3 class="text-white font-bold text-xl">Pomsky</h3>
                            <p class="text-white text-opacity-80">Pomeranian + Husky</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-amber-600">Playful</span>
                            <span class="text-sm dark:text-gray-400 text-gray-500">Small Size</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2">
                            <div class="h-2 bg-amber-600 rounded-full" style="width: 78%"></div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">78% compatibility score</p>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-sm border-amber-600 hover:shadow-lg hover:-translate-y-3 transition">
                    <div class="relative h-48">
                        <img src="{{ asset('images/chug.jpg') }}" alt="Chug" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-linear-to-t from-black to-transparent p-4">
                            <h3 class="text-white font-bold text-xl">Chug</h3>
                            <p class="text-white text-opacity-80">Chihuahua + Pug</p>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-amber-600">Affectionate</span>
                            <span class="text-sm dark:text-gray-400 text-gray-500">Tiny Size</span>
                        </div>
                        <div class="h-2 bg-gray-200 rounded-full mb-2">
                            <div class="h-2 bg-amber-600 rounded-full" style="width: 92%"></div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">92% compatibility score</p>
                    </div>
                </div>
            </div>
            
            <div class="text-center text-amber-600 mt-10">
                <a href="{{ url('/marketplace') }}" class="px-6 py-3 border-2 border-amber-600 rounded-lg font-semibold hover:bg-amber-600 hover:text-white transition">
                    Explore More Mixes
                </a>
            </div>
        </div>
    </section>
@endsection