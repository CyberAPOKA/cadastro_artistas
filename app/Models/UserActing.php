<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'acting_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acting()
    {
        return $this->belongsTo(Acting::class);
    }
}
