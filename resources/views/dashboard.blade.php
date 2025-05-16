@extends('layouts.app')

@section('content')
<div class="bg-orange-50 min-h-screen justify-center flex items-center">
    <div class="max-w-5xl mx-auto px-4 py-16">
        <!-- Welcome Section -->
        <div class="mb-12">
            <div class="text-3xl font-bold mb-4">Welcome to Mix N’ Breed</div>
            <p class="text-gray-700 text-lg mb-8 max-w-2xl">
                A site where you can get a generated preview look of a dog that is a mix of two different breeds! We also help you understand more about dog breeding, risks, and compatibility so you can become a better dog owner.
            </p>
            <a href="{{ auth()->check() ? route('dogmatch.form') : route('login') }}" class="inline-block bg-orange-400 text-white px-6 py-2 rounded-md font-semibold mb-4">Try it out!</a>
        </div>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 mb-16">
            <a href="{{ route('dogprofiles.all') }}">
                <div class="bg-orange-100 shadow rounded-lg p-8 text-center cursor-pointer hover:bg-orange-200 transition">
                    <div class="text-3xl font-bold text-orange-600">{{ $dogCount ?? '--' }}</div>
                    <div class="text-gray-700 mt-2">Dogs Registered</div>
                </div>
            </a>
            <div class="bg-blue-100 shadow rounded-lg p-8 text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $matchCount ?? '--' }}</div>
                <div class="text-gray-700 mt-2">Matches Made</div>
            </div>
            <div class="bg-green-100 shadow rounded-lg p-8 text-center">
                <div class="text-3xl font-bold text-green-600">{{ $tipCount ?? '--' }}</div>
                <div class="text-gray-700 mt-2">Health Tips</div>
            </div>
        </div>

        <!-- Image Section -->
        <div class="mb-16">
            <img src="{{ asset('images/gm.jpg') }}" alt="Dog Illustration" class="w-full max-w-3xl rounded-lg mx-auto border-4 border-orange-200 bg-orange-200 object-cover" style="height:420px;">
        </div>

        <!-- Guide Section -->
        <div>
            <div class="text-2xl font-semibold mb-8">Dog Breeding Guide</div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Card 1 -->
                <div>
                    <img src="{{ asset('images/compat.jpg') }}" alt="Compatibility" class="w-full h-40 object-cover rounded-md mb-4">
                    <div class="mb-2 font-semibold">Dog Breeding Compatibility</div>
                    <div class="text-gray-700 text-sm">Learn how to check if two dogs are a good match for breeding based on health, size, and temperament.</div>
                </div>
                <!-- Card 2 -->
                <div>
                    <img src="{{ asset('images/risks.jpg') }}" alt="Risks" class="w-full h-40 object-cover rounded-md mb-4">
                    <div class="mb-2 font-semibold">Risks of Dog Breeding</div>
                    <div class="text-gray-700 text-sm">Understand the potential health risks and responsibilities involved in dog breeding.</div>
                </div>
                <!-- Card 3 -->
                <div>
                    <img src="{{ asset('images/bett.jpg') }}" alt="Better Breeder" class="w-full h-40 object-cover rounded-md mb-4">
                    <div class="mb-2 font-semibold">Being a Better Dog Breeder</div>
                    <div class="text-gray-700 text-sm">Discover tips and resources to help you become a responsible and informed dog breeder.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
