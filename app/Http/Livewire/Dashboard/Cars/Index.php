<?php

namespace App\Http\Livewire\Dashboard\Cars;

use App\Models\Car;
use Livewire\Component;

class Index extends Component
{
    public $car_id;
    public $ppd;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function changePrice($car_id, $new_ppd)
    {
        $this->car_id = $car_id;
        $this->ppd = $new_ppd;
        $car = Car::findOrFail($this->car_id);
        $car->update(['ppd' => $new_ppd]);

        $this->emit('refreshComponent');
    }

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
