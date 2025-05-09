@extends('layouts.app')

@section('title', 'Get Started')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-orange-600 mb-6">Get Started with DogMatch</h1>
    <p class="mb-8 text-lg text-gray-700">
        Welcome to DogMatch! Follow these simple steps to start creating dog profiles and mixing breeds.
    </p>

    <ol class="list-decimal list-inside space-y-6 text-gray-800">
        <li>
            <h2 class="text-2xl font-semibold text-orange-500 mb-2">Create an Account</h2>
            <p>Sign up with your email and create a secure password to get started.</p>
        </li>
        <li>
            <h2 class="text-2xl font-semibold text-orange-500 mb-2">Add Your Dog Profiles</h2>
            <p>Go to <a href="{{ route('dogprofiles.create') }}" class="text-orange-600 underline">Add Dog Profile</a> and fill in your dog's details and photo.</p>
        </li>
        <li>
            <h2 class="text-2xl font-semibold text-orange-500 mb-2">Mix Dog Breeds</h2>
            <p>Visit the <a href="{{ route('dogmatch.form') }}" class="text-orange-600 underline">Dog Match</a> page to select two dogs and see their mixed breed results.</p>
        </li>
        <li>
            <h2 class="text-2xl font-semibold text-orange-500 mb-2">Explore More Features</h2>
            <p>Check out the <a href="{{ route('docs') }}" class="text-orange-600 underline">Documentation</a> for detailed guides and tips.</p>
        </li>
    </ol>
</div>
@endsection
