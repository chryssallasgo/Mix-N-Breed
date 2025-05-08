@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center bg-orange-50 bg-[url('/images/doggielogo.png')] bg-cover py-8">
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <img src="/images/doggielogo.png" alt="Dog Logo" class="w-16 h-16 mb-2">
            <h2 class="text-2xl font-bold text-orange-700 mb-1">Your Dog Profiles</h2>
            <a href="{{ route('dogprofiles.create') }}" class="mt-2 px-4 py-2 rounded-md bg-orange-400 text-white font-semibold hover:bg-orange-500 transition shadow">Add New Dog</a>
        </div>
        @if(session('success'))
            <div class="mb-4 text-green-600 text-center font-semibold">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($profiles as $profile)
                <div class="bg-orange-50 rounded-xl shadow p-4 flex flex-col items-center">
                    @if($profile->image)
                        <img src="{{ asset('storage/'.$profile->image) }}" alt="Dog Image" class="w-24 h-24 rounded-full mb-2 object-cover border-2 border-orange-200">
                    @else
                        <img src="/images/dog-logo.png" alt="Dog Image" class="w-24 h-24 rounded-full mb-2 object-cover border-2 border-orange-200 opacity-60">
                    @endif
                    <div class="text-lg font-bold text-orange-700">{{ $profile->breed }}</div>
                    <div class="text-gray-700">Age: <span class="font-semibold">{{ $profile->age ?? 'N/A' }}</span></div>
                    <div class="text-gray-700">Size: <span class="font-semibold">{{ $profile->size ?? 'N/A' }}</span></div>
                    <div class="text-gray-700">Traits: <span class="font-semibold">{{ $profile->traits ?? 'N/A' }}</span></div>
                </div>
            @empty
                <div class="col-span-2 text-center text-gray-500">No dog profiles yet. Add one!</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
