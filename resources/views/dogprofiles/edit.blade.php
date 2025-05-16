@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover">
    <div class="w-full max-w-lg bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <h2 class="text-2xl font-bold text-orange-700 mb-1">Edit Dog Profile</h2>
        </div>
        <form action="{{ route('dogprofiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4 justify-items-center">
                <label class="block text-orange-700 font-semibold mb-1 text-center">Current Image</label>
                @if($profile->image)
                    <img src="{{ asset('storage/'.$profile->image) }}" class="w-36 h-36 rounded-full mb-2 object-cover border-2 border-orange-200">
                @else
                    <span class="text-gray-500">No image uploaded.</span>
                @endif
            </div>
            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Change Image</label>
                <input type="file" name="image" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                @error('image')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Breed</label>
                <input type="text" name="breed" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('breed') border-red-400 @enderror" value="{{ old('breed', $profile->breed) }}">
                @error('breed')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Age</label>
                <input type="number" name="age" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('age') border-red-400 @enderror" value="{{ old('age', $profile->age) }}">
                @error('age')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="birthdate" class="block text-orange-700 font-semibold mb-1">Birthdate</label>
                <input type="date" name="birthdate" id="birthdate" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('birthdate') border-red-400 @enderror" value="{{ old('birthdate', $profile->birthdate ?? '') }}">
                @error('birthdate')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="weight" class="block text-orange-700 font-semibold mb-1">Weight</label>
                <input type="number" step="0.1" name="weight" id="weight" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('birthdate') border-red-400 @enderror" value="{{ old('weight', $profile->weight ?? '') }}" />
                @error('birthdate')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Size</label>
                <select name="size" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('size') border-red-400 @enderror">
                    <option value="">Select size</option>
                    <option value="Small" {{ old('size', $profile->size)=='Small'?'selected':'' }}>Small</option>
                    <option value="Medium" {{ old('size', $profile->size)=='Medium'?'selected':'' }}>Medium</option>
                    <option value="Large" {{ old('size', $profile->size)=='Large'?'selected':'' }}>Large</option>
                </select>
                @error('size')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block text-orange-700 font-semibold mb-1">Traits</label>
                <input type="text" name="traits" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('traits') border-red-400 @enderror" value="{{ old('traits', $profile->traits) }}">
                @error('traits')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 rounded-lg transition">
                Update Dog Profile
            </button>
        </form>
    </div>
</div>
@endsection
