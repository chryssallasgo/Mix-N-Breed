<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /** @use HasFactory<\Database\Factories\RegionFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'country',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function marketplaceItems()
    {
        return $this->hasMany(MarketplaceItem::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
