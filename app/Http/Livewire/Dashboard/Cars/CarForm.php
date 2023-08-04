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
    public $car_model_id;
    public $plate;
    public $ac;
    public $navigation;
    public $transmission_type;
    public $engine_type;
    public $max_passengers;
    public $ppd;

    public function mount()
    {
        $this->car = new Car;
        $this->car_brands = CarBrand::all();
        $this->car_models = CarModel::all();
    }

    public function rules()
    {
        return [
            'car.car_model_id' => 'required',
            'car.plate' => 'required',
            'car.ac' => 'required',
            'car.navigation' => 'required',
            'car.transmission_type' => 'required',
            'car.engine_type' => 'required',
            'car.max_passengers' => 'required',
            'car.ppd' => 'required',
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
        $car->car_model_id = $this->car_model_id;
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
        return view('livewire.dashboard.cars.car-form');
    }
}
