{{-- profile.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">View and Edit Profile 🐕</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Name
                </label>
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500"
                       id="name" name="name" type="text" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500"
                       id="email" name="email" type="email" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_photo">
                    Profile Photo
                </label>
                <div class="flex items-center">
                    <div class="mr-4">
                        @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                                 class="w-20 h-20 rounded-full object-cover" 
                                 alt="Current Profile Photo">
                        @else
                            <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No photo</span>
                            </div>
                        @endif
                    </div>
                    <input type="file" 
                           class="border rounded-lg p-2 w-full"
                           id="profile_photo" 
                           name="profile_photo"
                           accept="image/*">
                </div>
                @error('profile_photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-orange-400 text-white px-6 py-2 rounded-md font-semibold hover:bg-orange-500 transition">
                    Save Changes
                </button>
            </div>
        </form>
            <form method="POST" action="{{ route('profile.updatePassword') }}">
        @csrf
        @method('PUT')

        <h2 class="text-xl font-semibold mb-4 mt-8">Change Password</h2>

        <div class="mb-4">
            <label for="current_password" class="block text-gray-700 font-bold mb-2">Current Password</label>
            <input id="current_password" name="current_password" type="password" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500">
            @error('current_password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-bold mb-2">New Password</label>
            <input id="password" name="password" type="password" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" required
                class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:border-orange-500">
        </div>

        <button type="submit" class="bg-orange-400 text-white px-6 py-2 rounded-md font-semibold hover:bg-orange-500 transition">
            Update Password
        </button>
    </form>

    </div>
</div>
@endsection
