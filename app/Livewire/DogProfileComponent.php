<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\DogProfile as DogProfileModel;

class DogProfileComponent extends Component
{
    public $search = '';
    public $showMarketplaceForm = false;
    public $selectedProfileId = null;

    // Marketplace form fields
    public $marketplacePrice = '';
    public $marketplaceCategory = '';
    public $marketplaceDescription = '';
    public $owner_contact = '';

    public function toggleMarketplace($profileId)
    {
        $profile = DogProfileModel::where('user_id', Auth::id())->findOrFail($profileId);

        if ($profile->is_marketplace_visible) {
            // Remove from marketplace
            $profile->update([
                'is_marketplace_visible' => false,
                'marketplace_price' => null,
                'marketplace_category' => null,
                'marketplace_description' => null,
            ]);
        } else {
            // Show marketplace form
            $this->selectedProfileId = $profileId;
            $this->showMarketplaceForm = true;

            // Pre-fill with existing data if available
            $this->marketplacePrice = $profile->marketplace_price ?? '';
            $this->marketplaceCategory = $profile->marketplace_category ?? '';
            $this->marketplaceDescription = $profile->marketplace_description ?? $profile->traits;
            $this->owner_contact = $profile->owner_contact ?? Auth::user()->email;
        }
    }

    public function saveMarketplaceSettings()
    {
        $this->validate([
            'marketplacePrice' => 'required|numeric|min:0',
            'marketplaceCategory' => 'required|in:puppies,adult_dogs,breeding,adoption',
            'marketplaceDescription' => 'required|string|max:500',
            'owner_contact' => 'required|string|max:20',
        ]);

        $profile = DogProfileModel::where('user_id', Auth::id())->findOrFail($this->selectedProfileId);

        $profile->update([
            'is_marketplace_visible' => true,
            'marketplace_price' => $this->marketplacePrice,
            'marketplace_category' => $this->marketplaceCategory,
            'marketplace_description' => $this->marketplaceDescription,
            'owner_contact' => $this->owner_contact,
        ]);

        $this->reset(['showMarketplaceForm', 'selectedProfileId', 'marketplacePrice', 'marketplaceCategory', 'marketplaceDescription', 'owner_contact']);
    }

    public function cancelMarketplaceForm()
    {
        $this->reset(['showMarketplaceForm', 'selectedProfileId', 'marketplacePrice', 'marketplaceCategory', 'marketplaceDescription', 'owner_contact']);
    }

    public function render()
    {
        // search function
        $profiles = Auth::user()
            ->dogProfiles()
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('breed', 'like', '%' . $this->search . '%')
                        ->orWhere('traits', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.dog-profile-component', compact('profiles'));
    }
}
