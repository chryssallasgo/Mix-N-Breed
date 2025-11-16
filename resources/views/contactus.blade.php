@extends('layouts.app')

@section('title', 'Contact Us')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-12 bg-white mt-10 mb-10 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">Contact Us <img src="/images/Mail.svg" alt="Contact Icon" class="inline-block h-10 w-10 ml-2"></h1>
    <p class="text-gray-700 mb-4">If you have any questions or feedback, please feel free to reach out to us using the form below.</p>
    <form action="{{ url('/contactus') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" name="name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500">
        </div>
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea id="message" name="message" rows="4" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-orange-500 focus:border-orange-500"></textarea>
        </div>
        <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded-md">Send Message</button>
    </form>
</div>
@endsection