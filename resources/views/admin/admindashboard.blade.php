@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<section class="container px-4 mx-auto">
    <!-- Users Management Section -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8">
        <div>
            <div class="flex items-center gap-x-3 mt-10">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Registered Users</h2>
                <span class="px-3 py-1 text-xs text-orange-600 bg-orange-100 rounded-full dark:bg-gray-800 dark:text-orange-400">{{ $totalUsers }} users</span>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Manage all registered users in the system.</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            <a href="{{ route('register') }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-orange-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-orange-600 dark:hover:bg-orange-500 dark:bg-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Add User</span>
            </a>
        </div>
    </div>

    <!-- Search Bar for Users -->
    <div class="relative flex items-center mt-4 mb-6 md:mt-0">
        <span class="absolute">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </span>
        <input type="text" id="userSearch" placeholder="Search users..." class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-orange-400 dark:focus:border-orange-300 focus:ring-orange-300 focus:outline-none focus:ring focus:ring-opacity-40">
    </div>

    <!-- Users Table -->
    <div class="flex flex-col mt-6 mb-12">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-orange-400 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-100 dark:text-gray-400">
                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                        <span>User</span>
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-100 dark:text-gray-400">
                                    Email
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-100 dark:text-gray-400">
                                    Registered
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-100 dark:text-gray-400">
                                    Dog Profiles
                                </th>
                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($users as $user)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="flex items-center gap-x-3">
                                        @if($user->profile_picture)
                                            <img class="object-cover w-10 h-10 rounded-full" src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}">
                                        @else
                                            <div class="flex items-center justify-center w-10 h-10 text-white bg-orange-500 rounded-full">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h2 class="font-medium text-gray-800 dark:text-white">{{ $user->name }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">ID: {{ $user->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="text-gray-700 dark:text-gray-200">{{ $user->created_at->format('M d, Y') }}</div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $user->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full dark:bg-gray-800 dark:text-blue-400">
                                        {{ $user->dogProfiles->count() }} dogs
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 transition-colors duration-200 hover:text-blue-500 dark:hover:text-blue-400 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 transition-colors duration-200 hover:text-red-500 dark:hover:text-red-400 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination for Users -->
    <div class="mt-6 sm:flex sm:items-center sm:justify-between mb-12">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Page <span class="font-medium text-gray-700 dark:text-gray-100">{{ $users->currentPage() }} of {{ $users->lastPage() }}</span> 
        </div>
        <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Dog Profiles Management Section -->
    <div class="sm:flex sm:items-center sm:justify-between mb-8 mt-16">
        <div>
            <div class="flex items-center gap-x-3">
                <h2 class="text-lg font-medium text-gray-800 dark:text-white">Dog Profiles</h2>
                <span class="px-3 py-1 text-xs text-orange-600 bg-orange-100 rounded-full dark:bg-gray-800 dark:text-orange-400">{{ $totalDogProfiles }} profiles</span>
            </div>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">Manage all dog profiles in the system.</p>
        </div>

        <div class="flex items-center mt-4 gap-x-3">
            <a href="{{ route('dogmatch.form') }}" class="flex items-center justify-center w-1/2 px-5 py-2 text-sm tracking-wide text-white transition-colors duration-200 bg-orange-500 rounded-lg shrink-0 sm:w-auto gap-x-2 hover:bg-orange-600 dark:hover:bg-orange-500 dark:bg-orange-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Add Dog Profile</span>
            </a>
        </div>
    </div>

    <!-- Search Bar for Dog Profiles -->
    <div class="relative flex items-center mt-4 mb-6 md:mt-0">
        <span class="absolute">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mx-3 text-gray-400 dark:text-gray-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </span>
        <input type="text" id="dogSearch" placeholder="Search dog profiles..." class="block w-full py-1.5 pr-5 text-gray-700 bg-white border border-gray-200 rounded-lg md:w-80 placeholder-gray-400/70 pl-11 rtl:pr-11 rtl:pl-5 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-orange-400 dark:focus:border-orange-300 focus:ring-orange-300 focus:outline-none focus:ring focus:ring-opacity-40">
    </div>

    <!-- Dog Profiles Table -->
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-orange-50 dark:bg-gray-800">
                            <tr>
                                <th scope="col" class="py-3.5 px-4 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <button class="flex items-center gap-x-3 focus:outline-none">
                                        <span>Dog</span>
                                        <svg class="h-3" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M2.13347 0.0999756H2.98516L5.01902 4.79058H3.86226L3.45549 3.79907H1.63772L1.24366 4.79058H0.0996094L2.13347 0.0999756ZM2.54025 1.46012L1.96822 2.92196H3.11227L2.54025 1.46012Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                            <path d="M0.722656 9.60832L3.09974 6.78633H0.811638V5.87109H4.35819V6.78633L2.01925 9.60832H4.43446V10.5617H0.722656V9.60832Z" fill="currentColor" stroke="currentColor" stroke-width="0.1" />
                                            <path d="M8.45558 7.25664V7.40664H8.60558H9.66065C9.72481 7.40664 9.74667 7.42274 9.75141 7.42691C9.75148 7.42808 9.75146 7.42993 9.75116 7.43262C9.75001 7.44265 9.74458 7.46304 9.72525 7.49314C9.72522 7.4932 9.72518 7.49326 9.72514 7.49332L7.86959 10.3529L7.86924 10.3534C7.83227 10.4109 7.79863 10.418 7.78568 10.418C7.77272 10.418 7.73908 10.4109 7.70211 10.3534L7.70177 10.3529L5.84621 7.49332C5.84617 7.49325 5.84612 7.49318 5.84608 7.49311C5.82677 7.46302 5.82135 7.44264 5.8202 7.43262C5.81989 7.42993 5.81987 7.42808 5.81994 7.42691C5.82469 7.42274 5.84655 7.40664 5.91071 7.40664H6.96578H7.11578V7.25664V0.633865C7.11578 0.42434 7.29014 0.249976 7.49967 0.249976H8.07169C8.28121 0.249976 8.45558 0.42434 8.45558 0.633865V7.25664Z" fill="currentColor" stroke="currentColor" stroke-width="0.3" />
                                        </svg>
                                    </button>
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Details
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Status
                                </th>
                                <th scope="col" class="px-4 py-3.5 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    Owner
                                </th>
                                <th scope="col" class="relative py-3.5 px-4">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-900">
                            @foreach($dogProfiles as $profile)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-800">
                                <td class="px-4 py-4 text-sm font-medium whitespace-nowrap">
                                    <div class="flex items-center gap-x-3">
                                        @if($profile->image)
                                            <img class="object-cover w-12 h-12 rounded-lg" src="{{ asset('storage/' . $profile->image) }}" alt="{{ $profile->name }}">
                                        @else
                                            <div class="flex items-center justify-center w-12 h-12 text-white bg-orange-500 rounded-lg">
                                                🐕
                                            </div>
                                        @endif
                                        <div>
                                            <h2 class="font-medium text-gray-800 dark:text-white">{{ $profile->name }}</h2>
                                            <p class="text-xs font-normal text-gray-600 dark:text-gray-400">{{ $profile->breed }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div>
                                        <h4 class="text-gray-700 dark:text-gray-200">{{ ucfirst($profile->size) }} • {{ $profile->gender ? 'Male' : 'Female' }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Age: {{ $profile->age }} • {{ $profile->date_of_birth ? \Carbon\Carbon::parse($profile->date_of_birth)->format('M d, Y') : 'N/A' }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="space-y-1">
                                        <div class="inline px-2 py-1 text-xs font-normal rounded-full {{ $profile->vaccination_status ? 'text-emerald-500 bg-emerald-100/60' : 'text-red-500 bg-red-100/60' }} dark:bg-gray-800">
                                            {{ $profile->vaccination_status ? '✓ Vaccinated' : '✗ Not Vaccinated' }}
                                        </div>
                                        @if($profile->spayed_neutered)
                                        <div class="inline px-2 py-1 text-xs font-normal rounded-full text-blue-500 bg-blue-100/60 dark:bg-gray-800 ml-1">
                                            Spayed/Neutered
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div>
                                        <h4 class="text-gray-700 dark:text-gray-200">{{ $profile->user->name ?? 'N/A' }}</h4>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $profile->owner_contact ?? 'No contact' }}</p>
                                    </div>
                                </td>
                                <td class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex items-center gap-x-2">
                                        <a href="{{ route('admin.dogprofiles.edit', $profile->id) }}" class="text-blue-600 transition-colors duration-200 hover:text-blue-500 dark:hover:text-blue-400 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.dogprofiles.destroy', $profile->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this dog profile?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 transition-colors duration-200 hover:text-red-500 dark:hover:text-red-400 focus:outline-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination for Dog Profiles -->
    <div class="mt-6 sm:flex sm:items-center sm:justify-between mb-10">
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Page <span class="font-medium text-gray-700 dark:text-gray-100">{{ $dogProfiles->currentPage() }} of {{ $dogProfiles->lastPage() }}</span> 
        </div>
        <div class="flex items-center mt-4 gap-x-4 sm:mt-0">
            {{ $dogProfiles->links() }}
        </div>
    </div>
</section>

<!-- Optional: Add search functionality with Alpine.js or vanilla JS -->
<script>
    // Simple client-side search for users
    document.getElementById('userSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Simple client-side search for dog profiles
    document.getElementById('dogSearch')?.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const tables = document.querySelectorAll('table');
        const dogTable = tables[1]; // Second table is dog profiles
        
        if (dogTable) {
            const rows = dogTable.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        }
    });
</script>
@endsection