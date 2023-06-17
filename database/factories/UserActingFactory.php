<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Acting;
use App\Models\UserActing;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserActingFactory extends Factory
{
    protected $model = UserActing::class;

    public function definition()
    {
        $user = User::inRandomOrder()->first();
        $acting = Acting::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'acting_id' => $acting->id,
        ];
    }
}
