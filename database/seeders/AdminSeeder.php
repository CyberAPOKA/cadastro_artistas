<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //ADMINISTRADOR
        DB::table('admins')->insert([
            'email'         => 'cadastro@artistas.com',
            'password'      => Hash::make('secret'),
            'created_at'    => now(),
            'updated_at'    => now()
        ]);
    }
}
