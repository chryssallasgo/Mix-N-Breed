@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <img src="/images/doggielogo.png" alt="Dog Logo" class="w-16 h-16 mb-2">
            <h2 class="text-2xl font-bold text-orange-700 mb-1">Add a Dog Profile</h2>
            <p class="text-sm text-gray-500">Let’s meet your furry friend!</p>
        </div>
        <form action="{{ route('dogprofiles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Image</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                @error('image')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Breed</label>
                <input type="text" name="breed" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('breed') border-red-400 @enderror" value="{{ old('breed') }}">
                @error('breed')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Age</label>
                <input type="number" name="age" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('age') border-red-400 @enderror" value="{{ old('age') }}">
                @error('age')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Size</label>
                <select name="size" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('size') border-red-400 @enderror">
                    <option value="">Select size</option>
                    <option value="Small" {{ old('size')=='Small'?'selected':'' }}>Small</option>
                    <option value="Medium" {{ old('size')=='Medium'?'selected':'' }}>Medium</option>
                    <option value="Large" {{ old('size')=='Large'?'selected':'' }}>Large</option>
                </select>
                @error('size')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-orange-700 font-semibold mb-1">Traits</label>
                <input type="text" name="traits" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('traits') border-red-400 @enderror" value="{{ old('traits') }}" placeholder="e.g., Playful, Loyal">
                @error('traits')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white mb-4 font-bold py-2 rounded-lg transition">
                Save Dog Profile
            </button>
            <a href="{{ route('dogprofiles.index') }}" class=" mt-4  text-gray-400 hover:text-orange-300 font-bold py-2 px-4 rounded-lg transition">
                Back to Dog Profiles
            </a>
        </form>
    </div>
</div>
@endsection
