<?php

namespace App\Http\Livewire\Cars;

use App\Models\Car;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Location;
use App\Services\BookingHandlingService;

class Search extends Component
{
    public $booking = [];
    public $pick_up_id = '';
    public $drop_off_id = '';
    public $from_date;
    public $to_date;

    protected $rules = [
        'pick_up_id' => 'required',
        'drop_off_id' => 'required',
        'from_date' => 'required',
        'to_date' => 'required',
    ];

    protected $messages = [
        'pick_up_id.required' => 'Please specify pick up location',
        'drop_off_id.required' => 'Please specify drop off location',
        'from_date.required' => 'Please add start date',
        'to_date.required' => 'Please add end_date',
    ];

    public function availableCars(BookingHandlingService $bookingHandlingService)
    {
        $this->validate();

        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($this->from_date);
        $this->booking = new Booking;
        $this->booking->pick_up_id = $this->pick_up_id;
        $this->booking->drop_off_id = $this->drop_off_id;
        $this->booking->from_date = $date_and_time_of_pick_up['from_date'];
        $this->booking->to_date = $bookingHandlingService->format_to_date($this->to_date);
        $this->booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        $this->booking->save();

        return redirect()->route('available-cars', ['booking_id' => $this->booking->id]);
    }

    public function render()
    {
        $cars = Car::where('always_booked', false)->get();
        $locations = Location::all();

        return view('livewire.cars.search', compact('cars', 'locations'));
    }
}
