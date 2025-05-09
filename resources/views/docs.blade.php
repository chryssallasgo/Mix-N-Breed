@extends('layouts.app')

@section('title', 'Documentation')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-orange-600 mb-8">DogMatch Documentation</h1>

    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-4 border-b border-orange-300 pb-2">Overview</h2>
        <p class="text-gray-700 mb-4">
            DogMatch helps you create dog profiles and explore breed mixes using AI-powered matching.
        </p>
    </section>

    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-4 border-b border-orange-300 pb-2">Features</h2>
        <ul class="list-disc list-inside space-y-2 text-gray-800">
            <li><strong>Dog Profiles:</strong> Create, edit, and manage your dog’s profiles with photos and traits.</li>
            <li><strong>Dog Match:</strong> Select two dogs and generate a mixed breed profile.</li>
            <li><strong>User Accounts:</strong> Secure login and personalized data.</li>
        </ul>
    </section>

    <section class="mb-12">
        <h2 class="text-3xl font-semibold mb-4 border-b border-orange-300 pb-2">FAQ</h2>
        <dl class="space-y-4 text-gray-700">
            <dt class="font-semibold">How do I add a dog profile?</dt>
            <dd>Go to the "My Dogs" page and click "Add Dog Profile" to fill in your dog’s details.</dd>

            <dt class="font-semibold">Can I delete a dog profile?</dt>
            <dd>Yes, you can edit or delete your dog profiles anytime from the "My Dogs" page.</dd>

            <dt class="font-semibold">Is my data private?</dt>
            <dd>Yes, your dog profiles are only visible to you when logged in.</dd>
        </dl>
    </section>

    <section>
        <h2 class="text-3xl font-semibold mb-4 border-b border-orange-300 pb-2">Contact & Support</h2>
        <p class="text-gray-700">
            If you have questions or need help, please contact us at <a href="mailto:support@dogmatch.com" class="text-orange-600 underline">support@dogmatch.com</a>.
        </p>
    </section>
</div>
@endsection
