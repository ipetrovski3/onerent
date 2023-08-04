<?php

namespace App\Http\Livewire\Dashboard\Cars;

use Livewire\Component;
use App\Models\CarBrand;
use App\Models\CarModel;

class CarModelForm extends Component
{
    public $brands;
    public $name;
    public $car_brand_id;
    public $image;

    public function mount()
    {
        $this->brands = CarBrand::all();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'car_brand_id' => 'required',
            'image' => 'required|image|max:10240',
        ];
    }

    public function store()
    {
        $this->validate();
        $model = new CarModel;
        $model->name = $this->name;
        $model->car_brand_id = $this->car_brand_id;
        $this->image->store('cars', 'public');
        $model->image = $this->image->hashName();
        $model->save();
    }

    public function render()
    {
        return view('livewire.dashboard.cars.car-model-form');
    }
}
