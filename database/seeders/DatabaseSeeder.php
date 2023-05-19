<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\CarBrandSeeder;
use Database\Seeders\LocationSeeder;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\CountriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a default user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'remember_token' =>
            Hash::make('password'),
        ]);

        $this->call([
            CarBrandSeeder::class,
            CountriesSeeder::class,
            LocationSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
