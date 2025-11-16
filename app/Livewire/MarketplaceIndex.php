<?php
// app/Livewire/MarketplaceIndex.php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\MarketplaceItem;
use App\Models\Region;
use Illuminate\Support\Facades\Auth;
use App\Models\DogProfile as DogProfileModel;

class MarketplaceIndex extends Component
{
    use WithPagination;

    public $selectedRegion = null;
    public $search = '';
    public $category = '';
    public $priceRange = '';

    protected $queryString = [
        'selectedRegion' => ['except' => ''],
        'search' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    public function mount()
    {
        // Set user's region as default if logged in
        if (Auth::check() && Auth::user()->region_id) {
            $this->selectedRegion = Auth::user()->region_id;
        }
    }

    public function updatedSelectedRegion()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedPriceRange()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'category', 'priceRange']);
        $this->resetPage();
    }

    public function render()
    {
        $regions = Region::active()->orderBy('name')->get();

        // Get dog profiles that are marketplace visible
        $dogProfiles = DogProfileModel::query()
            ->with(['user', 'user.region'])
            ->marketplaceVisible()
            ->when($this->selectedRegion, function ($query) {
                $query->whereHas('user', function ($subQuery) {
                    $subQuery->where('region_id', $this->selectedRegion);
                });
            })
            ->when($this->search, function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('breed', 'like', '%' . $this->search . '%')
                        ->orWhere('marketplace_description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->category, function ($query) {
                $query->where('marketplace_category', $this->category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $categories = [
            'puppies' => 'Puppies',
            'adult_dogs' => 'Adult Dogs',
            'breeding' => 'Breeding',
            'adoption' => 'Adoption'
        ];

        return view('livewire.marketplace-index', [
            'items' => $dogProfiles,
            'regions' => $regions,
            'categories' => $categories
        ]);
    }
}
