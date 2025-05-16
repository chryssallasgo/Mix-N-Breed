
<div class="container py-4">
    <div class="flex justify-center">
        <div class="w-full md:w-8/12">
            <div class="card shadow-md">
                <div class="card-header bg-primary text-gray-100 text-center font-bold text-2xl mb-6">
                    <h1 class="mb-0 text-black">Mix Two Dog Breeds</h1>
                </div>
                <div class="card-body text-center">
                    <form wire:submit.prevent="mixBreeds" id="mixBreedsForm">
                        @csrf
                        <div class="mb-3">
                            <label for="breed1" class="form-label">First Dog Profile</label>
                            <select name="dog1_id" class="...">
                                <option value="">Choose first dog</option>
                                @foreach($profiles as $dog)
                                    <option value="{{ $dog->id }}" {{ (isset($selectedDogIds[0]) && $selectedDogIds[0] == $dog->id) ? 'selected' : '' }}>
                                        {{ $dog->breed }} ({{ $dog->age ?? 'N/A' }} yrs)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="breed2" class="form-label">Second Dog Profile</label>
                            <select name="dog2_id" class="...">
                                <option value="">Choose second dog</option>
                                @foreach($profiles as $dog)
                                    <option value="{{ $dog->id }}" {{ (isset($selectedDogIds[1]) && $selectedDogIds[1] == $dog->id) ? 'selected' : '' }}>
                                        {{ $dog->breed }} ({{ $dog->age ?? 'N/A' }} yrs)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button
                            type="submit"
                            class="btn btn-success inline-block bg-orange-400 text-white px-6 py-2 rounded-md font-semibold mb-4"
                            id="mixBreedsButton"
                            wire:loading.attr="disabled"
                        >
                            Mix Breeds
                        </button>
                    </form>

                    <div wire:loading.delay id="loadingSpinner" class="mt-8 flex justify-center items-center">
                        <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-orange-500"></div>
                    </div>

                    @if($hybrid_image)
                        <div class="flex flex-wrap justify-center items-start text-left gap-8 mt-8">
                            <div class="flex-grow-0 flex-shrink-0 w-[350px] text-center mb-5">
                                <img src="{{ $hybrid_image }}" alt="Hybrid Dog" class="max-w-full rounded-lg">
                            </div>
                            <div class="flex-grow-0 flex-shrink-0 w-[350px]">
                                <h3><strong>Breed Mix:</strong> {{ $mix_name }}</h3>
                                <ul>
                                    <li><strong>Life-Span:</strong> {{ $mix_info['life_span'] }}</li>
                                    <li><strong>Breed Compatibility:</strong> {{ $mix_info['compatibility'] }}</li>
                                    <li><strong>Risk:</strong> {{ $mix_info['risk'] }}</li>
                                    <li><strong>Date:</strong> {{ now()->format('l, F d, Y, h:i A') }}</li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-left mt-4 ml-65">
        <a href="{{ route('dogprofiles.create') }}" class="block px-4 py-2 rounded-md bg-orange-400 text-gray-100 hover:bg-orange-500 cursor-pointer">Add More Dogs 🐶!</a>
    </div>
    <div class="flex justify-left mt-4 ml-65">
        <p class="text-gray-600 text-sm">
            <strong>Note:</strong> The hybrid dog image is generated using a third-party API and may not represent an actual breed.
            The breed mix information is based on the selected dog profiles.
            Please consult a veterinarian for accurate breed information and health assessments.
        </p>
    </div>

</div>