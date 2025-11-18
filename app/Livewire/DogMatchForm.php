<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DogProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DogMatchForm extends Component
{
    public $selectedProfiles = [];
    public $resultImage;
    public $resultBreed;
    public $resultLifespan;
    public $resultSize;
    public $resultTraits;
    public $profiles;
    public $hasProfiles;
    public $selectedCount;

    public function mount()

    {
        $this->profiles = DogProfile::where('user_id', Auth::id())->get();
        $this->hasProfiles = $this->profiles->count() >= 2;
        $this->selectedCount = count($this->selectedProfiles);
    }

    public function toggleProfileSelection($profileId)
    {
        if (in_array($profileId, $this->selectedProfiles)) {
            $this->selectedProfiles = array_values(array_diff($this->selectedProfiles, [$profileId]));
        } else {
            if (count($this->selectedProfiles) < 2) {
                $this->selectedProfiles[] = $profileId;
            }
        }
    }

    public function isProfileSelected($profileId)
    {
        return in_array($profileId, $this->selectedProfiles);
    }

    public function canSelectMore()
    {
        return count($this->selectedProfiles) < 2;
    }

    public function getSelectedCount()
    {
        return count($this->selectedProfiles);
    }

    public function clearSelections()
    {
        $this->selectedProfiles = [];
    }

    public function mixBreeds()
    {
        if (count($this->selectedProfiles) !== 2) {
            session()->flash('error', 'Please select exactly 2 dogs to mix.');
            return;
        }

        // Your existing mix breeds logic here
        // Use $this->selectedProfiles[0] and $this->selectedProfiles[1] instead of profile1 and profile2

        // Example:
        $dog1 = DogProfile::find($this->selectedProfiles[0]);
        $dog2 = DogProfile::find($this->selectedProfiles[1]);

        // Your existing mixing logic...
    }

    public function render()
    {
        return view('livewire.dog-match-form', [
            'selectedCount' => $this->getSelectedCount(),
        ]);
    }
}
