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
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
