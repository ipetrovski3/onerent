<?php

namespace App\Http\Livewire\Dashboard\Cars;

use Livewire\Component;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class CarModelForm extends Component
{
    use WithFileUploads;

    public $car_brands;
    public $name;
    public $car_brand_id;
    public $image;
    public $carModels;
    public $newImage = [];

    public function mount()
    {
        $this->carModels = CarModel::all();
        
        $this->car_brands = CarBrand::all();
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

        return redirect()->route('detail.cars.index');
    }

    public function updatedNewImage($value, $carModelId)
    {
        $carModel = CarModel::find($carModelId);
        if ($carModel) {
            
            $this->validate([
                "newImage.$carModelId" => 'image|max:1024', // 1MB max
            ]);
                        
            if ($carModel->image) {
                Storage::disk('public')->delete('cars/' . $carModel->image);
            }

            $this->newImage[$carModelId]->store('cars', 'public');
            $carModel->update(['image' => $this->newImage[$carModelId]->hashName()]);
        }
    }

    public function render()
    {
        return view('livewire.dashboard.cars.car-model-form');
    }
}
