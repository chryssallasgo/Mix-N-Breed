@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col items-center bg-orange-50 py-8">
    <div class="w-full max-w-5xl bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <h2 class="text-3xl font-bold text-orange-700 mb-6 text-center">Dogs Registered by All Users</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse($profiles as $profile)
                <a href="{{ route('dogprofiles.show', $profile->id) }}" class="block bg-orange-50 rounded-xl shadow p-4 hover:shadow-lg transition">
                    @if($profile->image)
                        <img src="{{ asset('storage/'.$profile->image) }}" alt="Dog Image" class="w-32 h-32 rounded-full mb-2 object-cover border-2 border-orange-200 mx-auto">
                    @else
                        <img src="/images/dog-logo.png" alt="Dog Image" class="w-32 h-32 rounded-full mb-2 object-cover border-2 border-orange-200 opacity-60 mx-auto">
                    @endif
                    <div class="text-lg font-bold text-orange-700 text-center">{{ $profile->breed }}</div>
                    <div class="text-gray-700 text-center">Owner: <span class="font-semibold">{{ $profile->user->name ?? 'Unknown' }}</span></div>
                </a>
            @empty
                <div class="col-span-3 text-center text-gray-500">No dog profiles found.</div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $profiles->links() }} <!-- Pagination links -->
        </div>
    </div>
</div>
@endsection
