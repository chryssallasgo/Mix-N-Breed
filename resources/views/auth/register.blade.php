@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <img src="/images/doggielogo.png" alt="Dog Logo" class="w-16 h-16 mb-2">
            <h2 class="text-3xl font-bold text-orange-700 mb-1">Join the Pack!</h2>
            <p class="text-sm text-gray-500">Create your Mix N' Breed account</p>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-orange-700 font-semibold mb-1">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('name') border-red-400 @enderror">
                @error('name')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-orange-700 font-semibold mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('email') border-red-400 @enderror">
                @error('email')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-orange-700 font-semibold mb-1">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('password') border-red-400 @enderror">
                @error('password')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password-confirm" class="block text-orange-700 font-semibold mb-1">Confirm Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition">
                Register
            </button>
            <div class="mt-4 text-center">
                <span class="text-gray-600 text-sm">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
