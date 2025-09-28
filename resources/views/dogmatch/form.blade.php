@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-lg border-2 border-orange-200">
        <div class="flex flex-col items-center mb-6">
            <img src="{{ asset('images/doggielogo.png') }}" alt="Dog Match Logo" class="w-20 h-20 mb-2 drop-shadow-lg">
            <h2 class="text-3xl font-extrabold text-orange-700 mb-2 tracking-tight">Mix Two Breeds!</h2>
            <p class="text-gray-600 text-center mb-4">Upload two dog images below and see what their mix could look like. 🐶✨</p>
        </div>
        <form action="{{ route('dogmatch.process') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block font-semibold mb-2 text-orange-700" for="dog1">
                    <span class="inline-block mr-2">🐾</span>Dog Image 1
                </label>
                <input type="file" name="dog1" id="dog1" accept="image/*" required class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                <div class="flex justify-center mt-2">
                    <img id="preview1" src="{{ asset('images/doggielogoprev.png') }}" alt="Preview 1" class="w-28 h-28 rounded-full object-cover border-2 border-orange-200 bg-orange-100 shadow-inner">
                </div>
                @error('dog1')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2 text-orange-700" for="dog2">
                    <span class="inline-block mr-2">🐾</span>Dog Image 2
                </label>
                <input type="file" name="dog2" id="dog2" accept="image/*" required class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" />
                <div class="flex justify-center mt-2">
                    <img id="preview2" src="{{ asset('images/doggielogoprev.png') }}" alt="Preview 2" class="w-28 h-28 rounded-full object-cover border-2 border-orange-200 bg-orange-100 shadow-inner">
                </div>
                @error('dog2')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition text-lg shadow-lg flex items-center justify-center gap-2">
                <span>Mix Breeds</span> <span>🐕‍🦺</span>
            </button>
        </form>
    </div>
</div>

{{-- Live image preview script --}}
<script>
document.getElementById('dog1').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('preview1').src = URL.createObjectURL(file);
    }
});
document.getElementById('dog2').addEventListener('change', function(event) {
    const [file] = event.target.files;
    if (file) {
        document.getElementById('preview2').src = URL.createObjectURL(file);
    }
});
</script>
@endsection