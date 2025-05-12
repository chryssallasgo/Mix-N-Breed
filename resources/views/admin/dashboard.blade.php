@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6 text-orange-600">Admin Dashboard</h1>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-2">Total Registered Users</h2>
            <p class="text-4xl font-bold text-gray-800">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-xl font-semibold mb-2">Total Dog Profiles</h2>
            <p class="text-4xl font-bold text-gray-800">{{ $totalDogProfiles }}</p>
        </div>
    </div>

    <!-- Users Management -->
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4">Manage Users</h2>
        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-orange-500 text-white">
                    <th class="py-3 px-4 text-left">ID</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Registered At</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b hover:bg-orange-50">
                    <td class="py-2 px-4">{{ $user->id }}</td>
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="py-2 px-4 space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this user?');">
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
            {{ $users->links() }}
        </div>
    </div>

    <!-- Dog Profiles Management -->
    <div>
        <h2 class="text-2xl font-semibold mb-4">Manage Dog Profiles</h2>
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
</div>
@endsection
