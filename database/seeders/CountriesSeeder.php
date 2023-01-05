<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = File::get('database/json/countries.json');
        $countries = json_decode($countries);
        foreach ($countries as $country) {
            \App\Models\Country::create([
                'name' => $country->name,
                'code' => $country->code
            ]);
        }
    }
}
