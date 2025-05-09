<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DogProfile extends Model
{
    protected $fillable = [
        'image',
        'breed',
        'age',
        'size',
        'traits',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
