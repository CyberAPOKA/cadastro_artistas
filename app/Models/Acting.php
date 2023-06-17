<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acting extends Model
{
    use HasFactory;

    protected $fillable = [
        'acting'
    ];

    public function users()
    {
        return $this->hasMany(UserActing::class, 'acting_id', 'id')->with('user.profile', 'user.address');
    }
}
