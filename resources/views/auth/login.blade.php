@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/skid.jpg')] bg-cover">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <img src="/images/doggielogo.png" alt="Dog Logo" class="w-16 h-16 mb-2">
            <h2 class="text-3xl font-bold text-orange-700 mb-1">Welcome Back!</h2>
            <p class="text-sm text-gray-500">Log in to Mix N' Breed</p>
        </div>
        @if(session('error'))
            <div class="mb-4 text-red-600 text-center font-semibold">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-orange-700 font-semibold mb-1">Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
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

            <div class="flex items-center mb-4">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-gray-600 text-sm">Remember Me</label>
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition">
                Login
            </button>
            <div class="mt-4 text-center">
                <span class="text-gray-600 text-sm">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-orange-600 font-bold hover:underline">Sign Up</a>
            </div>
        </form>
    </div>
</div>
@endsection
