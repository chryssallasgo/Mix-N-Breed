<div class="min-h-screen flex flex-col items-center bg-orange-50 bg-[url('/images/doggielogo.png')] bg-cover py-8">

    {{-- Marketplace Form Modal --}}
    @if($showMarketplaceForm)
        <div class="fixed inset-0 bg-orange-100/50 bg-opacity-10 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 max-w-md w-full mx-4 max-h-screen overflow-y-auto">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Add to Marketplace</h3>
                
                <form wire:submit.prevent="saveMarketplaceSettings">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price (₱)</label>
                        <input type="number" 
                               wire:model="marketplacePrice"
                               step="0.01"
                               min="0"
                               class="w-full rounded-md border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                               placeholder="0.00">
                        @error('marketplacePrice') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select wire:model="marketplaceCategory" 
                                class="w-full rounded-md border-gray-300 focus:border-orange-500 focus:ring-orange-500">
                            <option value="">Select Category</option>
                            <option value="puppies">Puppies</option>
                            <option value="adult_dogs">Adult Dogs</option>
                            <option value="breeding">Breeding</option>
                            <option value="adoption">Adoption</option>
                        </select>
                        @error('marketplaceCategory') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model="marketplaceDescription"
                                  rows="3"
                                  class="w-full rounded-md border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                                  placeholder="Describe your dog..."></textarea>
                        @error('marketplaceDescription') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                        <input type="text" 
                               wire:model="owner_contact"
                               class="w-full rounded-md border-gray-300 focus:border-orange-500 focus:ring-orange-500"
                               placeholder="09XX XXX XXXX">
                        @error('owner_contact') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" 
                                wire:click="cancelMarketplaceForm"
                                class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="flex-1 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors">
                            Add to Marketplace
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Search Bar --}}
        <div class="w-screen max-w-2xl bg-white rounded-2xl shadow-lg p-4 border-2 border-orange-200 mb-5">
            <div class="flex items-center justify-center">
                <div class="flex flex-col w-full max-w-md space-y-2 md:flex-row md:space-y-0 md:space-x-2">
                    <div class="relative w-full grow">     
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>

                        <input type="text" 
                            wire:model.live.debounce.300ms="search" 
                            name="search" 
                            class="w-full bg-gray-100 text-base outline-none rounded-md py-2 pl-10 pr-4 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-500" 
                            placeholder="Search here...">
                    </div>      
                    <a href="/dogprofiles/create" 
                    class="flex justify-center w-full md:w-auto shrink-0 bg-orange-500 text-white py-2 px-4 rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-opacity-50 whitespace-nowrap">
                        Add dog profile
                    </a>
                </div>
            </div>
        </div>

    {{-- Profile Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl">
        @foreach($profiles as $profile)
            <div class="bg-white rounded-xl p-6 shadow-lg border-2 border-orange-200">
                {{-- Marketplace Status Badge (Compact) --}}
                <div class="flex justify-end mb-2">
                    @if($profile->is_marketplace_visible)
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            In Marketplace
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Private
                        </span>
                    @endif
                </div>

                {{-- Profile Header --}}
                <div class="flex items-center mb-4">
                    <img src="{{ $profile->image ? asset('storage/' . $profile->image) : asset('images/dogprofile.jpg') }}" 
                         alt="{{ $profile->name }}" 
                         class="w-16 h-16 rounded-full object-cover border-2 border-orange-300 mr-4">
                    <div>
                        <h3 class="font-bold text-lg text-orange-700">{{ $profile->name }}</h3>
                        <p class="text-gray-600">{{ $profile->breed }}</p>
                        @if($profile->is_marketplace_visible && $profile->marketplace_price)
                            <p class="text-lg font-bold text-green-600">₱{{ number_format($profile->marketplace_price, 0) }}</p>
                        @endif
                    </div>
                </div>

                {{-- Profile Details Grid --}}
                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div><strong>Age:</strong> {{ $profile->age }} {{ $profile->age == 1 ? 'year' : 'years' }}</div>
                    <div><strong>Size:</strong> {{ ($profile->size) }}</div>
                    <div><strong>Weight:</strong> {{ $profile->weight }} kg</div>
                    <div><strong>Gender:</strong> {{ ($profile->gender ? 'Male' : 'Female') }}</div>
                </div>

                {{-- Health Information --}}
                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div><strong>Vaccinated:</strong>
                        @php $v = strtolower(trim((string)$profile->vaccination_status)); @endphp
                        {{ $v === 'up to date' ? 'Up to date' : ($v === 'not up to date' ? 'Not up to date' : 'Unknown') }}
                    </div>
                    <div><strong>Health:</strong> {{ ($profile->health_status) }}</div>
                    <div><strong>Spayed/Neutered:</strong> {{ $profile->spayed_neutered ? 'Yes' : 'No' }}</div>
                    <div><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($profile->date_of_birth)->format('M d, Y') }}</div>
                </div>

                {{-- Traits --}}
                <div class="mb-4">
                    <strong class="text-sm">Traits:</strong>
                    <p class="text-gray-700 text-sm mt-1">{{ $profile->traits }}</p>
                </div>

                <div class="mb-4 text-sm">
                    <strong>Owner Contact:</strong> {{ $profile->owner_contact }}
                </div>

                <div class="flex flex-col space-y-2">
                    <div class="flex space-x-2">
                        <a href="{{ route('dogprofiles.edit', $profile->id) }}" 
                           class="bg-orange-500 hover:bg-orange-400 text-white px-2 py-2 rounded-lg text-sm font-medium transition-colors flex-1 text-center">
                            Edit
                        </a>
                        
                        <form action="{{ route('dogprofiles.destroy', $profile->id) }}" 
                              method="POST" 
                              class="flex-1"
                              onsubmit="return confirm('Are you sure you want to delete this profile?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Delete
                            </button>
                        </form>
                    </div>

                    <button wire:click="toggleMarketplace({{ $profile->id }})"
                            class="w-full px-4 py-2 rounded-lg text-sm font-medium transition-colors
                                   {{ $profile->is_marketplace_visible 
                                      ? 'bg-yellow-500 hover:bg-yellow-600 text-white' 
                                      : 'bg-green-500 hover:bg-green-600 text-white' }}">
                        {{ $profile->is_marketplace_visible ? 'Remove from Marketplace' : 'Add to Marketplace' }}
                    </button>
                </div>
            </div>
        @endforeach

        @if($profiles->isEmpty())
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No dog profiles yet</h3>
                <p class="text-gray-500 mb-4">Create your first dog profile to get started!</p>
                <a href="{{ route('dogprofiles.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white rounded-lg font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Dog Profile
                </a>
            </div>
        @endif
    </div>
</div>