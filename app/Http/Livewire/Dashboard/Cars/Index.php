<?php

namespace App\Http\Livewire\Dashboard\Cars;

use App\Models\Car;
use Livewire\Component;

class Index extends Component
{
    public function disableBooking($car_id)
    {
        $car = Car::find($car_id);
        $car->always_booked = !$car->always_booked;
        $car->save();
    }

    public function render()
    {
        $cars = Car::all();
        $transmissions = Car::transmissions();
        $engines = Car::engines();

        return view('livewire.dashboard.cars.index', compact('cars', 'transmissions', 'engines'));
    }
}
