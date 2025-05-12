@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-orange-600 mb-6">About DogMatch</h1>
    <p class="mb-6 text-gray-700 text-lg leading-relaxed">
        DogMatch was created with a simple mission: to help dog lovers connect and explore the wonderful world of dog breeds.
        Whether you want to create detailed profiles of your furry friends or discover exciting breed mixes, we’re here to make it fun and easy.
    </p>

    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Our Story</h2>
    <p class="mb-6 text-gray-700 leading-relaxed">
        Founded by passionate dog enthusiasts and tech lovers, DogMatch combines the love for dogs with the power of technology.
        Our team believes every dog has a unique story, and we want to help you tell it.
    </p>

    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Our Values</h2>
    <ul class="list-disc list-inside mb-6 text-gray-700 space-y-2">
        <li><strong>Community:</strong> Building a friendly space for dog lovers to share and learn.</li>
        <li><strong>Innovation:</strong> Using AI and smart tools to bring new experiences.</li>
        <li><strong>Privacy:</strong> Your dog profiles are always yours and secure.</li>
        <li><strong>Fun:</strong> Making dog care and discovery enjoyable for everyone.</li>
    </ul>

    <h2 class="text-2xl font-semibold text-orange-500 mb-4">Meet the Team</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
        <div class="bg-orange-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-2">Iway, Mark Jorland</h3>
            <p class="text-gray-700">Founder & Developer. Dog lover and back-end wizard.</p>
        </div>
        <div class="bg-orange-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-2">Allasgo, Chryssdale Heart</h3>
            <p class="text-gray-700">Designer & Hipster. Passionate about UX and pups.</p>
        </div>
        <div class="bg-orange-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-2">Marte, Ares Daniel</h3>
            <p class="text-gray-700">Project Manager. Leads the team to pup paradise</p>
        </div>
        <div class="bg-orange-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-2">Igot, Chelsie</h3>
            <p class="text-gray-700">Backend Assistant. Helps the hacker regarding back-end coding.</p>
        </div>
        <div class="bg-orange-50 p-6 rounded-lg shadow">
            <h3 class="text-xl font-bold mb-2">Lumapas, Nina Regene</h3>
            <p class="text-gray-700">Project Manager Assistant. Helps the manager manage the things that needs to be managed.</p>
        </div>
    </div>

    <h2 class="text-2xl font-semibold text-orange-500 mt-10 mb-4">Get in Touch</h2>
    <p class="text-gray-700 mb-4">
        We’d love to hear from you! Whether you have questions, feedback, or just want to share a cute dog photo, reach out at
        <a href="mailto:contact@dogmatch.com" class="text-orange-600 underline">contact@dogmatch.com</a>.
    </p>
</div>
@endsection
