<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserActing;

class UserActingsSeeder extends Seeder
{
    public function run(): void
    {
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            UserActing::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
