@extends('layouts.app')

@section('title', 'Edit Dog Profile')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-orange-600">Edit Dog Profile: {{ $profile->breed }}</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.dogprofiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="breed" class="block font-semibold mb-1">Breed</label>
            <input type="text" name="breed" id="breed" value="{{ old('breed', $profile->breed) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
        </div>

        <div class="mb-4">
            <label for="age" class="block font-semibold mb-1">Age</label>
            <input type="number" name="age" id="age" value="{{ old('age', $profile->age) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
        </div>

        <div class="mb-4">
            <label for="size" class="block font-semibold mb-1">Size</label>
            <input type="text" name="size" id="size" value="{{ old('size', $profile->size) }}"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
        </div>

        <div class="mb-4">
            <label for="traits" class="block font-semibold mb-1">Traits</label>
            <textarea name="traits" id="traits" rows="3"
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500">{{ old('traits', $profile->traits) }}</textarea>
        </div>

        <div class="mb-6">
            <label for="image" class="block font-semibold mb-2">Dog Image</label>
            @if($profile->image)
                <img src="{{ asset('storage/' . $profile->image) }}" alt="Dog Image" class="mb-4 max-h-48 rounded shadow">
            @endif
            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-red-700" />
        </div>

        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded">
            Update Profile
        </button>
        <a href="{{ route('admin.dogprofiles.index') }}" class="ml-4 text-orange-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
