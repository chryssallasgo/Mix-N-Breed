<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DogProfile extends Model
{
    protected $fillable = [
        'image',
        'breed',
        'size',
        'traits',
        'birthdate',
        'weight',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getAgeAttribute()
    {
        if (!$this->birthdate) {
            return null;
        }
        return Carbon::parse($this->birthdate)->age;
    }
    public function getHumanEquivalentAgeAttribute()
    {
        $dogAge = $this->age;
        if (!$dogAge) {
            return null;
        }
        // Example formula: human age = 16 * ln(dog age) + 31
        return round(16 * log($dogAge) + 31);
    }
    public function getWeightLbsAttribute()
    {
        return $this->weight ? round($this->weight * 2.20462, 1) : null;
    }
}
