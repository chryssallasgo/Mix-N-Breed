<div class="min-h-screen bg-orange-50 bg-[url('/images/doggielogo.png')] bg-cover py-8">
    <div class="max-w-3xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-lg p-8 border-2 border-orange-200">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-orange-700 mb-2">My Profile</h2>
                <p class="text-gray-600">Manage your account information</p>
            </div>
            
            <div class="space-y-6">
                <div class="flex items-center space-x-4 p-4 bg-orange-50 rounded-lg border border-orange-200">
                        @if(Auth::user()->profile_picture)
                            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                                alt="{{ Auth::user()->name }}" 
                                class="h-15 w-15 rounded-full object-cover border-2 border-orange-300">
                        @else
                            <div class="h-8 w-8 rounded-full bg-orange-200 flex items-center justify-center border-2 border-orange-300">
                                <span class="text-sm font-bold text-orange-600">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            </div>
                        @endif
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <p class="text-gray-900 font-semibold">{{ $user->name }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <p class="text-gray-900 font-semibold">{{ $user->email }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Member Since</label>
                        <p class="text-gray-900 font-semibold">{{ $user->created_at->format('F d, Y') }}</p>
                    </div>
                    
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Account Status</label>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    </div>
                </div>

                <div class="flex justify-center space-x-4 pt-6">
                    <a href="{{ route('userprofile.edit') }}" 
                       class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        Edit in Account Settings
                    </a>
                    <a href="{{ route('dogprofiles.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        My Dog Profiles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>