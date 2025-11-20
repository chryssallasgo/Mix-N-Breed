@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
<div class="min-h-screen flex items-center justify-center dark:bg-gray-800 bg-orange-50 px-4">
    <div class="max-w-md w-full bg-white p-8 rounded-md shadow">
        <img src="/images/adpn.svg" alt="Dog Logo" class="w-30 h-30 mb-2 image-center mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-orange-600 text-center">Admin Login</h1>

        @if($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <label for="email" class="block font-semibold mb-1 ">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full mb-4 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" />

            <label for="password" class="block font-semibold mb-1 ">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full mb-6 px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-500" />

            <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 rounded">
                Login
            </button>
        </form>
    </div>
</div>
@endsection
