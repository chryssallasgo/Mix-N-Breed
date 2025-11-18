<div class="min-h-screen flex items-center justify-center bg-orange-50 bg-[url('/images/doggielogo.png')] bg-cover">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-2xl shadow-2xl w-full max-w-6xl border-2 border-orange-200">
        {{-- Result Display --}}
        <div class="flex flex-col">
            {{-- Header --}}
            <div class="flex flex-col items-center mb-6">

                <h2 class="text-2xl md:text-3xl font-extrabold text-orange-700 mb-2 tracking-tight">Mix Two Breeds!<img src="{{ asset('images/doggielogo.png') }}" alt="Dog Match Logo" class="w-10 h-10 mb-2 drop-shadow-lg"></h2>
                <p class="text-sm md:text-base text-gray-600 text-center">Select two dog profiles to see their mix.</p>
            </div>
            <div class="flex-1 flex flex-col items-center justify-start pt-8">
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
                <div class="flex justify-between items-center mb-4">
                    <label class="block font-semibold text-orange-700"> Select Two Dogs</label>
                    <span class="text-sm text-gray-600">Selected: {{ count($selectedProfiles) }}/2</span>
                </div>
                <div class="bg-white rounded-lg shadow p-6 h-100 flex flex-col">
                    @if($profiles->isEmpty())
                        <div class="text-center py-4">
                            <p class="text-gray-600 mb-2">You haven't made a dog profile yet.</p>
                            <a href="{{ route('dogprofiles.create') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                                Create one here
                            </a>
                        </div>
                    @else
                        <div class="max-h-[600px] [scrollbar-gutter:stable] 
                                    scrollbar-thin scrollbar-thumb-orange-200 scrollbar-track-transparent
                                    hover:scrollbar-thumb-orange-300">
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($profiles as $profile)
                                    <div wire:click="toggleProfileSelection({{ $profile->id }})"
                                         class="relative cursor-pointer transform transition-all duration-300 hover:scale-105 group
                                                {{ $this->isProfileSelected($profile->id) ? 'ring-2 ring-orange-500 scale-105 shadow-lg' : 'hover:shadow-xl' }}">
                                        {{-- Profile Card --}}
                                        <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                                            <img src="{{ asset('storage/'.$profile->image) }}" 
                                                 alt="{{ $profile->name }}"
                                                 class="w-[256px] h-[164px] object-cover transition-transform duration-300 group-hover:scale-110">
                                            
                                            <div class="absolute inset-0 bg-linear-to-t from-black via-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 bg-clip-padding backdrop-filter backdrop-blur bg-opacity-5 backdrop-saturate-100 backdrop-contrast-100 {{ $this->isProfileSelected($profile->id) ? 'opacity-100' : '' }}">
                                                <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                                    <p class="font-medium mb-1">{{ $profile->name }}</p>
                                                    <p class="text-sm">{{ $profile->breed }}</p>
                                                    <div class="mt-2 text-xs space-y-1">
                                                        <p>Age: {{ $profile->age }}</p>
                                                        <p>Weight: {{ $profile->weight }}</p>
                                                        <p>Health: {{ $profile->health_status }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @if($this->isProfileSelected($profile->id))
                                            <div class="absolute top-2 right-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs shadow-lg">
                                                ({{ array_search($profile->id, $selectedProfiles) + 1 }}/2)
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if(!$hasProfiles)
                            <div class="mt-4 text-center text-sm text-blue-700 bg-blue-100 p-3 rounded-lg">
                                You have {{ $profiles->count() }} profile. Please add at least one more to use the breed mixer.
                            </div>
                        @endif
                    @endif
                </div>

                <div class="flex gap-4">
                    <button wire:click="mixBreeds"
                            class="w-full text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300
                                   {{ count($selectedProfiles) == 2 ? 'bg-orange-500 hover:bg-orange-600' : 'bg-gray-400 cursor-not-allowed' }}"
                            @disabled(count($selectedProfiles) != 2)>
                        Mix Breeds
                    </button>
                    <button wire:click="clearSelections"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition-colors">
                        Clear
                    </button>
                </div>

                {{-- loadingscreen or spinner --}}
            <div wire:loading.flex wire:target="mixBreeds" class="absolute inset-0 bg-gray-100/50 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-md w-full text-center border-2 border-orange-300">
                    <img src="{{ asset('images/doggielogo.png') }}" alt="MixNBreed Logo" class="h-16 mx-auto mb-4">
                    <div class="w-full h-8 bg-gray-200 rounded-full overflow-hidden relative my-6">
                        <div class="h-full w-full bg-linear-to-r from-orange-400 via-amber-500 to-cyan-500 pawgress-animation"></div>
                        <div class="absolute inset-0 flex items-center justify-between px-2">
                            @for ($i = 0; $i < 10; $i++)
                    <img src="{{ asset('images/loader.png') }}" alt="MixNBreed Logo" class="h-6 mx-auto " style="transform: rotate({{ rand(-25, 25) }}deg);">
                            @endfor
                        </div>
                    </div>

                    <h3 class="text-xl font-bold text-gray-800">Hold on to your Dogs!</h3>
                    <p class="text-gray-600 mt-1">Calculating cuteness... wagging tails!</p>
                </div>
            </div>

                {{-- error messages --}}
                @if (session()->has('error'))
                    <div class="text-red-500 text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
