<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogProfile extends Model
{
    public $dogProfiles;

    protected $fillable = [
        'image',
        'name',
        'breed',
        'age',
        'size',
        'traits',
        'user_id',
        'gender',
        'weight',
        'vaccination_status',
        'health_status',
        'spayed_neutered',
        'owner_contact',
        'date_of_birth',
        'is_marketplace_visible',
        'marketplace_price',
        'marketplace_category',
        'marketplace_description',
        'contact_number',
    ];
    protected $casts = [
        'is_marketplace_visible' => 'boolean',
        'marketplace_price' => 'decimal:2',
    ];
    public function scopeMarketplaceVisible($query)
    {
        return $query->where('is_marketplace_visible', true);
    }
    public function getMarketplaceCategoryLabelAttribute()
    {
        $categories = [
            'puppies' => 'Puppies',
            'adult_dogs' => 'Adult Dogs',
            'breeding' => 'Breeding',
            'adoption' => 'Adoption'
        ];
        return $categories[$this->marketplace_category] ?? null;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
