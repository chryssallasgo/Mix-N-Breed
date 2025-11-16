<div class="min-h-screen flex flex-col items-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover py-8">
    @if (session()->has('message'))
        <div class="fixed top-20 left-1/2 transform -translate-x-1/2 z-60 mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg max-w-md shadow-lg">
            <div class="flex items-center justify-between">
                <span>{{ session('message') }}</span>
                <button onclick="this.parentElement.parentElement.style.display='none'" class="ml-4 text-green-600 hover:text-green-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    {{-- Marketplace Form Modal --}}
    @if($showMarketplaceForm)
        <div class="fixed inset-0 bg-white bg-opacity-10 flex items-center justify-center z-50">
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

    {{-- Original Search Section --}}
    <div class="w-full max-w-3xl bg-white rounded-2xl shadow-lg p-4 border-2 border-orange-200 mb-5">
        <div class="flex items-center justify-center">
            <div class="rounded-lg p-2">
                <input type="text" 
                       wire:model.live.debounce.300ms="search" 
                       name="search" 
                       class="w-full bg-gray-200 pl-2 text-base outline-0 rounded-md py-2 px-50" 
                       placeholder="Search here...">
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
                    <div><strong>Size:</strong> {{ ucfirst($profile->size) }}</div>
                    <div><strong>Weight:</strong> {{ $profile->weight }} kg</div>
                    <div><strong>Gender:</strong> {{ ucfirst($profile->gender) }}</div>
                </div>

                {{-- Health Information --}}
                <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                    <div><strong>Vaccinated:</strong> {{ $profile->vaccination_status ? 'Yes' : 'No' }}</div>
                    <div><strong>Health:</strong> {{ ucfirst($profile->health_status) }}</div>
                    <div><strong>Spayed/Neutered:</strong> {{ $profile->spayed_neutered ? 'Yes' : 'No' }}</div>
                    <div><strong>Birthday:</strong> {{ \Carbon\Carbon::parse($profile->date_of_birth)->format('M d, Y') }}</div>
                </div>

                {{-- Traits --}}
                <div class="mb-4">
                    <strong class="text-sm">Traits:</strong>
                    <p class="text-gray-700 text-sm mt-1">{{ $profile->traits }}</p>
                </div>

                {{-- Contact Information --}}
                <div class="mb-4 text-sm">
                    <strong>Owner Contact:</strong> {{ $profile->owner_contact }}
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-col space-y-2">
                    {{-- First row: Edit and Delete --}}
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

                    {{-- Second row: Marketplace Toggle --}}
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

        {{-- Empty State --}}
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