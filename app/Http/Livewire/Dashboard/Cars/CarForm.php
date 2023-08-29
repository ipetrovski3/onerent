<?php

namespace App\Http\Livewire\Dashboard\Cars;

use App\Models\Car;
use Livewire\Component;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarForm extends Component
{
    public $car;
    public $car_brands;
    public $car_models;
    public $brand;
    public $model;
    public $plate;
    public $ac = true;
    public $navigation = true;
    public $transmission_type;
    public $engine_type;
    public $max_passengers = 5;
    public $ppd;

    public function rules()
    {
        return [
            'brand' => 'required',
            'model' => 'required',
            'plate' => 'required',
            'ac' => 'required',
            'navigation' => 'required',
            'transmission_type' => 'required',
            'engine_type' => 'required',
            'max_passengers' => 'required',
            'ppd' => 'required',
        ];
    }

    public function clean_plate($plate)
    {
        $plate = str_replace(' ', '', $plate);
        $plate = strtoupper($plate);
        return $plate;
    }

    public function store()
    {
        $this->validate();
        $car = new Car;
        $car->car_model_id = $this->model;
        $car->plate = $this->clean_plate($this->plate);
        $car->ac = $this->ac;
        $car->navigation = $this->navigation;
        $car->transmission_type = $this->transmission_type;
        $car->engine_type = $this->engine_type;
        $car->max_passengers = $this->max_passengers;
        $car->ppd = $this->ppd;
        $car->save();

        return redirect()->route('cars.index');
    }

    public function render()
    {
        $this->car_brands = CarBrand::all();
        $this->car_models = CarModel::where('car_brand_id', $this->brand)->get();

        $transmissions = Car::transmissions();
        $engines = Car::engines();

        return view('livewire.dashboard.cars.car-form', compact('transmissions', 'engines'));
    }
}
