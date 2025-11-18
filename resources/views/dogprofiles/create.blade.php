@extends('layouts.app')

@section('content')
<div class="min-h-screen mt-10 mb-10 flex items-center justify-center bg-orange-50 bg-[url('/images/skid.jpg')] bg-cover">
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
            <div class="mb-6">
                <label class="block text-orange-700 font-semibold mb-1">Name</label>
                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('name') border-red-400 @enderror" value="{{ old('name') }}" placeholder="e.g., Lily, Max">
                @error('name')
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
            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Gender</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="1" class="mr-1" {{ old('gender') == '1' ? 'checked' : '' }}> Male
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="0" class="mr-1" {{ old('gender') == '0' ? 'checked' : '' }}> Female
                    </label>
                </div>
                @error('gender')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Weight (kg)</label>
                <input type="number" name="weight" step="0.1" min="0" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('weight') border-red-400 @enderror" value="{{ old('weight') }}">
                @error('weight')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Vaccination Status</label>
                <select name="vaccination_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('vaccination_status') border-red-400 @enderror">
                    <option value="">Select status</option>
                    <option value="Up to date" {{ old('vaccination_status')=='Up to date'?'selected':'' }}>Up to date</option>
                    <option value="Not up to date" {{ old('vaccination_status')=='Not up to date'?'selected':'' }}>Not up to date</option>
                    <option value="Unknown" {{ old('vaccination_status')=='Unknown'?'selected':'' }}>Unknown</option>
                </select>
                @error('vaccination_status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Health Status</label>
                <select name="health_status" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('health_status') border-red-400 @enderror">
                    <option value="">Select health status</option>
                    <option value="Healthy" {{ old('health_status')=='Healthy'?'selected':'' }}>Healthy</option>
                    <option value="Special needs" {{ old('health_status')=='Special needs'?'selected':'' }}>Special needs</option>
                    <option value="Allergies" {{ old('health_status')=='Allergies'?'selected':'' }}>Allergies</option>
                    <option value="Other" {{ old('health_status')=='Other'?'selected':'' }}>Other</option>
                </select>
                @error('health_status')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Spayed/Neutered</label>
                <div class="flex items-center space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" name="spayed_neutered" value="1" class="mr-1" {{ old('spayed_neutered') == '1' ? 'checked' : '' }}> Yes
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="spayed_neutered" value="0" class="mr-1" {{ old('spayed_neutered') == '0' ? 'checked' : '' }}> No
                    </label>
                </div>
                @error('spayed_neutered')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Owner Contact Info</label>
                <input type="text" name="owner_contact" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('owner_contact') border-red-400 @enderror" value="{{ old('owner_contact') }}">
                @error('owner_contact')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-orange-700 font-semibold mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300 @error('date_of_birth') border-red-400 @enderror" value="{{ old('date_of_birth') }}">
                @error('date_of_birth')
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
