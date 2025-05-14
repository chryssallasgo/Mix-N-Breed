@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-orange-600">Edit User: {{ $user->name }}</h1>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-orange-500" />
        </div>

        <div class="mb-6">
            <label for="is_admin" class="inline-flex items-center">
                <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                    class="form-checkbox h-5 w-5 text-orange-600" />
                <span class="ml-2 font-semibold">Administrator</span>
            </label>
        </div>

        <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white font-semibold px-6 py-2 rounded">
            Update User
        </button>
        <a href="{{ route('admin.users.index') }}" class="ml-4 text-orange-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
