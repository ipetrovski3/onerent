<?php

namespace App\Http\Livewire\Dashboard\Cars;

use App\Models\Car;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $cars = Car::all();
        return view('livewire.dashboard.cars.index', compact('cars'));
    }
}
