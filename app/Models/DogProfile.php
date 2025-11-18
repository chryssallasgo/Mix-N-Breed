<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DogProfile extends Model
{

    use HasFactory;

    protected $fillable = [
        'image',
        'user_id',
        'name',
        'breed',
        'age',
        'size',
        'traits',
        'gender',
        'weight',
        'date_of_birth',
        'vaccination_status',
        'health_status',
        'spayed_neutered',
        'owner_contact',
        'is_marketplace_visible',
        'marketplace_price',
        'marketplace_category',
        'marketplace_description',
    ];
    protected $casts = [
        'spayed_neutered' => 'boolean',
        'date_of_birth' => 'date',
        'is_marketplace_visible' => 'boolean',
        'marketplace_price' => 'decimal:2',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
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
}
