<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/paws-bg.png')] bg-cover">
    <div class="grid grid-cols-2 gap-8 bg-white p-8 rounded-2xl shadow-2xl w-full max-w-6xl border-2 border-orange-200">
        {{-- Result Display --}}
        <div class="flex flex-col">
            {{-- Header --}}
            <div class="flex flex-col items-center mb-6">
                <img src="{{ asset('images/doggielogo.png') }}" alt="Dog Match Logo" class="w-20 h-20 mb-2 drop-shadow-lg">
                <h2 class="text-3xl font-extrabold text-orange-700 mb-2 tracking-tight">Mix Two Breeds!</h2>
                <p class="text-gray-600 text-center">Select two dog profiles to see their mix. 🐶✨</p>
            </div>
            <div class="flex-1 flex flex-col items-center justify-start pt-8">
                <h3 class="text-2xl font-bold text-orange-700 mb-4">Resulting Mix</h3>
                <img src="{{ $resultImage ?? asset('images/doggielogoprev.png') }}" 
                     class="w-40 h-40 rounded-full object-cover border-2 border-orange-300 shadow-inner mb-4">
                <div class="text-sm text-gray-700 space-y-1">
                    <p><strong>Breed:</strong> {{ $resultBreed ?? '—' }}</p>
                    <p><strong>Lifespan:</strong> {{ $resultLifespan ?? '—' }}</p>
                    <p><strong>Size:</strong> {{ $resultSize ?? '—' }}</p>
                    <p><strong>Traits:</strong> {{ $resultTraits ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- Dog Selection --}}
        <div class="flex flex-col">
            <form wire:submit.prevent="mixBreeds" class="space-y-6">
                {{-- Selection Counter --}}
                <div class="flex justify-between items-center mb-4">
                    <label class="block font-semibold text-orange-700">🐾 Select Two Dogs</label>
                    <span class="text-sm text-gray-600">Selected: {{ $selectedCount }}/2</span>
                </div>

                {{-- Dog Profile Selection Grid --}}
                <div class="bg-white rounded-lg shadow p-6">
                    @if(!$hasProfiles)
                        <div class="text-center py-4">
                            <p class="text-gray-600 mb-2">You haven't made a dog profile yet.</p>
                            <a href="{{ route('dogprofiles.create') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                                Create one here
                            </a>
                        </div>
                    @else
                        <div class="max-h-[500px] overflow-y-auto">
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($profiles as $profile)
                                    <div wire:click="toggleProfileSelection({{ $profile->id }})"
                                         class="relative cursor-pointer transform transition-all duration-300 hover:scale-105 group
                                                {{ $this->isProfileSelected($profile->id) ? 'ring-2 ring-orange-500 scale-105 shadow-lg' : 'hover:shadow-xl' }}">
                                        {{-- Profile Card --}}
                                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/'.$profile->image) }}" 
                                                 alt="{{ $profile->name }}"
                                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                                            
                                            {{-- Hover Info Overlay --}}
                                            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <p class="font-medium mb-1">{{ $profile->name }}</p>
                                                    <p class="text-sm">{{ $profile->breed }}</p>
                                                    <div class="mt-2 text-xs space-y-1">
                                                        <p>Age: {{ $profile->age }}</p>
                                                        <p>Size: {{ $profile->size }}</p>
                                                        <p>Health: {{ $profile->health_status }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Selection Indicator --}}
                                        @if($this->isProfileSelected($profile->id))
                                            <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs shadow-lg">
                                                Selected ({{ array_search($profile->id, $selectedProfiles) + 1 }}/2)
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4">
                    @if($selectedCount > 0)
                        <button type="button" wire:click="clearSelections" 
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-3 rounded-lg transition">
                            Clear Selection
                        </button>
                    @endif
                    <button type="submit" 
                            class="flex-1 bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 rounded-lg transition text-lg shadow-lg flex items-center justify-center gap-2"
                            {{ $selectedCount !== 2 ? 'disabled' : '' }}
                            :class="{ 'opacity-50 cursor-not-allowed': {{ $selectedCount !== 2 }} }">
                        <span>Mix Breeds</span> <span>🐕‍🦺</span>
                    </button>
                </div>

                {{-- Loading State --}}
                <div wire:loading wire:target="mixBreeds" class="text-center text-gray-600">
                    Mixing breeds...
                </div>

                {{-- Error Messages --}}
                @if (session()->has('error'))
                    <div class="text-red-500 text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>