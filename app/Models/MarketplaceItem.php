<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketplaceItem extends Model
{
    /** @use HasFactory<\Database\Factories\MarketplaceItemFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category',
        'images',
        'contact_number',
        'user_id',
        'region_id',
        'is_active',
    ];
    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopeInRegion($query, $regionId)
    {
        return $query->where('region_id', $regionId);
    }
    public function getMainImageAttribute()
    {
        return $this->images && count($this->images) > 0 ? $this->images[0] : null;
    }
}
