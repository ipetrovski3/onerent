<?php

namespace Database\Seeders;

use App\Models\CarBrand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CarBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = File::get("database/json/carbrands.json");
        $models = json_decode($json);

        foreach ($models as $model) {
            CarBrand::create(['name' => $model->name]);
        }
    }
}
