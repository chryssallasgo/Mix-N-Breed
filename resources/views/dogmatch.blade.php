@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h2 class="mb-0">Mix Two Dog Breeds</h2>
                </div>
                <div class="card-body text-center">
                    <form method="POST" action="{{ route('dogmatch.mix') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="breed1" class="form-label">First Dog Breed</label>
                            <select id="breed1" name="breed1" class="form-select" required>
                                <option value="">Choose a breed</option>
                                @foreach($breeds as $breed)
                                    <option value="{{ $breed }}">{{ $breed }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="breed2" class="form-label">Second Dog Breed</label>
                            <select id="breed2" name="breed2" class="form-select" required>
                                <option value="">Choose a breed</option>
                                @foreach($breeds as $breed)
                                    <option value="{{ $breed }}">{{ $breed }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success inline-block bg-orange-400 text-white px-6 py-2 rounded-md font-semibold mb-4">Mix Breeds</button>
                    </form>

                    @if(isset($hybrid_image))
                    <div style="display: flex; align-items: center; justify-content: center; margin-top: 2rem;">
                        <div style="flex: 0 0 350px; text-align: center;">
                            <img src="{{ $hybrid_image }}" alt="Hybrid Dog" style="max-width: 100%; border-radius: 12px;">
                        </div>
                        <div style="flex: 0 0 350px; margin-left: 2rem;">
                            <h3>Breed Mix: {{ $mix_name }}</h3>
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
</div>
@endsection
