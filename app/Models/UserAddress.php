<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'neighborhood',
        'city',
        'zip_code',
        'state_registration',
        'municipal_registration'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
