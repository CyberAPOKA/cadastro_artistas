<?php

namespace Database\Seeders;

use App\Models\Acting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('pt_BR');

        $actings = Acting::pluck('acting');

        $users = User::where('id', '>', 0)->get();

        foreach ($users as $user) {
            $cpf_cnpj = $faker->randomElement(['cpf', 'cnpj']);
            $value = $faker->$cpf_cnpj(false);

            DB::table('user_profiles')->insert([
                'user_id'       => $user->id,
                'name'          => $faker->name,
                'representative'          => $faker->name,
                'phone'            => $faker->phoneNumber,
                'website'          => $faker->url,
                'gender' => $faker->randomElement(['Feminino (cisgênero)', 'Masculino (cisgênero)', 'Transgênero Feminino', 'Transgênero Masculino', 'Não Binário']),
                'race' => $faker->randomElement(['Amarela', 'Branca', 'Preta', 'Parda', 'Indígena']),
                'film_friendly_network' => $faker->randomElement([null, 'Gastronomia', 'Hotelaria', 'Transporte', 'Entidades e empresas parceiras']),
                'created_at'    => now(),
                'updated_at'    => now(),
                $cpf_cnpj => $value,
                $cpf_cnpj == 'cpf' ? 'cnpj' : 'cpf' => null,
            ]);
        }
    }
}
