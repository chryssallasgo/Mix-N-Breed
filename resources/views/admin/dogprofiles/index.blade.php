@extends('layouts.app')

@section('title', 'Manage Dog Profiles')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-orange-600">Manage Dog Profiles</h1>
<a href="{{ route('admin.admindashboard') }}" class="ml-4 text-orange-600 hover:underline">Back to Dashboard</a>
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-orange-500 text-white">
                <th class="py-3 px-4 text-left">ID</th>
                <th class="py-3 px-4 text-left">Owner</th>
                <th class="py-3 px-4 text-left">Breed</th>
                <th class="py-3 px-4 text-left">Age</th>
                <th class="py-3 px-4 text-left">Size</th>
                <th class="py-3 px-4 text-left">Traits</th>
                <th class="py-3 px-4 text-left">Created At</th>
                <th class="py-3 px-4 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dogProfiles as $profile)
            <tr class="border-b hover:bg-orange-50">
                <td class="py-2 px-4">{{ $profile->id }}</td>
                <td class="py-2 px-4">{{ $profile->user->name ?? 'N/A' }}</td>
                <td class="py-2 px-4">{{ $profile->breed }}</td>
                <td class="py-2 px-4">{{ $profile->age ?? '-' }}</td>
                <td class="py-2 px-4">{{ $profile->size ?? '-' }}</td>
                <td class="py-2 px-4">{{ $profile->traits ?? '-' }}</td>
                <td class="py-2 px-4">{{ $profile->created_at->format('Y-m-d') }}</td>
                <td class="py-2 px-4 space-x-2">
                    <a href="{{ route('admin.dogprofiles.edit', $profile->id) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.dogprofiles.destroy', $profile->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this dog profile?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $dogProfiles->links() }}
    </div>
</div>
@endsection
