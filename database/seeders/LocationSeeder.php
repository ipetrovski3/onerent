<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location = new \App\Models\Location();
        $location->name = 'Skopje Airport';
        $location->lat = 41.9614;
        $location->long = 21.6214;
        $location->save();
    }
}
