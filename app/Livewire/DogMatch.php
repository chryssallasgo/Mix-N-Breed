<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\DogMatchController;
use Illuminate\Support\Facades\Auth;

class DogMatch extends Component
{
    public $breed1;
    public $breed2;
    public $profiles;
    public $hybrid_image;
    public $mix_name;
    public $mix_info;
    public $isLoading = false;
    public $mixNames;

    public function mount()
    {
        // Fetch all dog profiles from the database
        $this->profiles = auth()->user()->dogProfiles;
    }
    public function mixBreeds()
    {
        $this->isLoading = true;

        $controller = app(DogMatchController::class);
        $data = $controller->mix(request()->merge([
            'dog1_id' => $this->breed1,
            'dog2_id' => $this->breed2,
        ]));

        $this->hybrid_image = $data['hybrid_image'];
        $this->mix_name = $data['mix_name'];
        $this->mix_info = $data['mix_info'];
        $this->mixNames = $data['mixNames'];
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.dog-match');
    }
}
