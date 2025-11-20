<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <div class="bg-white dark:bg-gray-800 shadow-sm border-b sticky top-16 z-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-3">
                {{-- Location Selector, took inspiration from carousell.ph --}}
                <div class="flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <div class="relative">
                            <select wire:model.live="selectedRegion" 
                                    class="appearance-none bg-transparent pr-8 pl-2 py-1 text-sm font-medium text-gray-700 dark:text-gray-300 focus:outline-none focus:ring-0 border-none">
                                <option value="">All Philippines</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-0 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400 dark:text-gray-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    @if($selectedRegion)
                        <span class="text-xs bg-orange-100 text-orange-600 px-2 py-1 rounded-full">
                            {{ $regions->find($selectedRegion)?->name }}
                        </span>
                    @endif
                </div>

                {{-- search bar --}}
                <div class="flex-1 max-w-lg mx-4">
                    <div class="relative">
                        <input type="text" 
                               wire:model.live.debounce.300ms="search"
                               placeholder="Search for dogs, accessories, services..."
                               class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                {{-- Post Ad Button --}}
                <a href="#" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    + Post Ad
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex gap-6">
            {{-- Sidebar filters inspired from Petfinder website --}}
            <div class="w-64 flex-shrink-0">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-32">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Filters</h3>
                    
                    {{-- Category filter --}}
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Category</label>
                        <div class="space-y-2">
                            @foreach($categories as $key => $label)
                                <label class="flex items-center">
                                    <input type="radio" 
                                           wire:model.live="category" 
                                           value="{{ $key }}"
                                           class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                    <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Price Range</label>
                        <div class="space-y-2">
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="priceRange" value="under_1000" class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                <span class="ml-2 text-sm text-gray-700">Under ₱1,000</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="priceRange" value="1000_5000" class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                <span class="ml-2 text-sm text-gray-700">₱1,000 - ₱5,000</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="priceRange" value="5000_10000" class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                <span class="ml-2 text-sm text-gray-700">₱5,000 - ₱10,000</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" wire:model.live="priceRange" value="over_10000" class="w-4 h-4 text-orange-600 border-gray-300 focus:ring-orange-500">
                                <span class="ml-2 text-sm text-gray-700">Over ₱10,000</span>
                            </label>
                        </div>
                    </div>
                    @if($search || $category || $priceRange)
                        <button wire:click="clearFilters" 
                                class="w-full text-center text-sm text-orange-600 hover:text-orange-700 font-medium">
                            Clear all filters
                        </button>
                    @endif
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">
                            @if($selectedRegion)
                                Dogs & Pet Supplies in {{ $regions->find($selectedRegion)?->name }}
                            @else
                                Dogs & Pet Supplies
                            @endif
                        </h1>
                        <p class="text-gray-600 mt-1">{{ $items->total() }} results found</p>
                    </div>
                </div>

                {{-- Items Grid (Petfinder Style) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow overflow-hidden border border-gray-200">
                        {{-- Image --}}
                        <div class="relative h-48 bg-gray-100">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                    alt="{{ $item->name }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            @endif
                            
                            {{-- Category Badge --}}
                            <div class="absolute top-3 left-3">
                                <span class="bg-white bg-opacity-90 text-gray-800 px-2 py-1 rounded text-xs font-medium">
                                    {{ $categories[$item->marketplace_category] ?? 'Dog' }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 mb-1">{{ $item->breed }} • {{ $item->age }} {{ $item->age == 1 ? 'year' : 'years' }} old</p>
                            <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $item->marketplace_description }}</p>
                            
                            {{-- Price --}}
                            <div class="text-2xl font-bold text-orange-600 mb-3">
                                ₱{{ number_format($item->marketplace_price, 0) }}
                            </div>

                            {{-- Location and Seller --}}
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $item->user->region->name ?? 'Philippines' }}</span>
                                </div>
                                <span>{{ $item->updated_at->diffForHumans() }}</span>
                            </div>

                            {{-- Contact Button --}}
                            <div class="pt-4 border-t border-gray-100">
                                <a href="tel:{{ $item->owner_contact }}" 
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-2 rounded-lg text-sm font-medium transition-colors block text-center">
                                    Contact: {{ $item->owner_contact }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 mb-4">
                                <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">No results found</h3>
                            <p class="text-gray-500 mb-4">Try adjusting your search or filters to find what you're looking for.</p>
                            <button wire:click="clearFilters" class="text-orange-600 hover:text-orange-700 font-medium">
                                Clear all filters
                            </button>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div class="mt-8">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>