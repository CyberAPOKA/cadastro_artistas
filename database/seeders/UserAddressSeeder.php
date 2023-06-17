<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $users = User::where('id', '>', 0)->get();

        foreach ($users as $user) {
            DB::table('user_addresses')->insert([
                'user_id'       => $user->id,
                'address'        => $faker->address,
                'neighborhood'      => $faker->address,
                'city'          => $faker->city,
                'zip_code'      => $faker->postcode,
                'state_registration'        => $faker->numberBetween($min = 1, $max = 9999),
                'municipal_registration'        => $faker->numberBetween($min = 1, $max = 9999),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);
        }
    }
}
