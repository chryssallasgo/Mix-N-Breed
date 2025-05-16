@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 py-8">
    <div class="bg-white rounded-3xl shadow-xl border-2 border-orange-200 max-w-md w-full p-8 flex flex-col items-center">
        <div class="relative">
            <img src="{{ $profile->image ? asset('storage/'.$profile->image) : '/images/dog-logo.png' }}"
                 class="w-40 h-40 rounded-full border-4 border-orange-300 shadow-lg object-cover mb-4">
        </div>
        <h2 class="text-3xl font-extrabold text-orange-700 mb-2">{{ $profile->breed }}</h2>

        <div class="flex flex-col items-center space-y-2 text-gray-700 mb-4">
            <div class="flex items-center gap-2">
                <span class="material-icons">cake</span>
                <span>Age:</span>
                <span class="font-bold">{{ $profile->age ?? 'N/A' }}</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="material-icons">fitness_center</span>
                <span>Weight:</span>
                <span class="font-bold">{{ $profile->weight ?? 'N/A' }} kg</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined">straighten</span>
                <span>Size:</span>
                <span class="font-bold">{{ $profile->size ?? 'N/A' }}</span>
            </div>
            <div>
                <span class="font-semibold">Birth Date:</span>
                <span>{{ $profile->birthdate ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="mb-4 w-full">
            <div class="font-semibold text-orange-600 mb-1">Traits:</div>
            <div class="bg-orange-50 rounded-lg p-2 text-center">
                {{ $profile->traits ?? 'N/A' }}
            </div>
        </div>

        <div class="mt-4 text-center text-gray-600">
            <div class="font-semibold">Owner: <span class="text-orange-700">{{ $profile->user->name ?? 'N/A' }}</span></div>
            <div>
                <span class="font-semibold">Email:</span>
                <a href="mailto:{{ $profile->user->email ?? '#' }}" class="text-blue-500 hover:underline">
                    {{ $profile->user->email ?? 'N/A' }}
                </a>
            </div>
        </div>

        <a
        href="{{ route('dogprofiles.all') }}" class="bg-white text-center  w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
        type="button"
        >
        <div
            class="bg-orange-400 rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500"
        >
            <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1024 1024"
            height="25px"
            width="25px"
            >
            <path
                d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                fill="#f5f5f5"
            ></path>
            <path
                d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                fill="#f5f5f5"
            ></path>
            </svg>
        </div>
        <p class="translate-x-2 translate-y-3">Go Back</p>
        </a>
        @php
            // Get current selected dog IDs from query or session or empty array
            $currentSelectedDogs = request()->query('dog_ids', []);
            if (!is_array($currentSelectedDogs)) {
                $currentSelectedDogs = [$currentSelectedDogs];
            }
            // Add this dog's id if not already included
            if (!in_array($profile->id, $currentSelectedDogs)) {
                $currentSelectedDogs[] = $profile->id;
            }
        @endphp

        <a href="{{ route('dogmatch.form', ['dog_ids' => $currentSelectedDogs]) }}"
        class="px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition">
        Add to AI Match
        </a>
    </div>
</div>

@endsection
