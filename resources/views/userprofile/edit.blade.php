{{-- filepath: e:\BSIT 3rd Year\2nd sem\BSIT_third_Year\Mix_N_Breed\mixnbreed\resources\views\userprofile\edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="bg-orange-50 w-full flex flex-col gap-5 px-3 md:px-16 lg:px-28 md:flex-row">

    <!-- Sticky Sidebar -->
    <aside class="hidden md:w-1/3 lg:w-1/4 py-8 md:block">
        <div class="sticky top-24 flex flex-col gap-2 p-4 border bg-white rounded-xl shadow-md">
            <h3 class="font-bold text-lg mb-2 text-gray-800">Navigation</h3>
            <a href="{{ route('userprofile.edit') }}" class="px-4 py-2 font-semibold text-gray-400 rounded-md">
               Account Settings
            </a>

            <hr class="my-2">

            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors text-center" role="menuitem">
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="md:w-2/3 lg:w-3/4 w-full py-8 min-h-screen">
        <div class="max-w-2xl mx-auto space-y-8">
                        <!-- Profile Picture Form -->
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Profile Picture
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Update your profile picture. Maximum file size: 2MB.
                    </p>
                </header>

                <form method="post" action="{{ route('userprofile.picture') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
                    @csrf

                    <!-- Current Profile Picture -->
                    <div class="flex items-center space-x-6">
                        <div class="shrink-0">
                            @if($userprofile->profile_picture)
                                <img src="{{ asset('storage/' . $userprofile->profile_picture) }}" 
                                     alt="{{ $userprofile->name }}" 
                                     class="h-24 w-24 object-cover rounded-full border-4 border-orange-300">
                            @else
                                <div class="h-24 w-24 rounded-full bg-orange-200 flex items-center justify-center border-4 border-orange-300">
                                    <span class="text-3xl font-bold text-orange-600">{{ strtoupper(substr($userprofile->name, 0, 1)) }}</span>
                                </div>
                            @endif
                        </div>

                        <div class="flex-1">
                            <label for="profile_picture" class="block font-medium text-sm text-gray-700 mb-2">Choose New Picture</label>
                            <input id="profile_picture" 
                                   name="profile_picture" 
                                   type="file" 
                                   accept="image/*"
                                   class="block w-full text-sm text-gray-500
                                          file:mr-4 file:py-2 file:px-4
                                          file:rounded-full file:border-0
                                          file:text-sm file:font-semibold
                                          file:bg-orange-50 file:text-orange-700
                                          hover:file:bg-orange-100
                                          @error('profile_picture') border-red-400 @enderror">
                            @error('profile_picture') 
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Upload Picture
                        </button>
                    </div>
                </form>
            </div>
            <!-- Profile Information Form -->
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Profile Information
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Update your account's profile information and email address.
                    </p>
                </header>

                <form method="post" action="{{ route('userprofile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block font-medium text-sm text-gray-700">Name</label>
                        <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" value="{{ old('name', $userprofile->name) }}" required autofocus autocomplete="name" />
                        @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" value="{{ old('email', $userprofile->email) }}" required autocomplete="username" />
                        @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">Save</button>
                        @if (session('status') === 'profile-updated')
                            <p class="text-sm text-gray-600">Saved.</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Update Password Form -->
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-md border">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Update Password
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block font-medium text-sm text-gray-700">Current Password</label>
                        <input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" autocomplete="current-password" />
                        @error('current_password', 'updatePassword') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password" class="block font-medium text-sm text-gray-700">New Password</label>
                        <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" autocomplete="new-password" />
                        @error('password', 'updatePassword') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-orange-500 focus:ring-orange-500" autocomplete="new-password" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-lg transition-colors">Save</button>
                        @if (session('status') === 'password-updated')
                            <p class="text-sm text-gray-600">Saved.</p>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Delete Account Section -->
            <div class="bg-red-200 p-6 md:p-8 rounded-xl shadow-md border border-red-400">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Delete Account
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                    </p>
                </header>
                
                <form method="post" action="{{ route('userprofile.destroy') }}" class="mt-6">
                    @csrf
                    @method('delete')
                    
                    <button type="submit" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Delete Account
                    </button>
                </form>
            </div>

        </div>
    </main>
</div>
@endsection