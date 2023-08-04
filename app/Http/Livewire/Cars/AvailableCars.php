<?php

namespace App\Http\Livewire\Cars;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\BookingHandlingService;

class AvailableCars extends Component
{
    public $booking = [];
    public $pick_up_id = '';
    public $drop_off_id = '';
    public $from_date;
    public $to_date;
    // public $cars;
    public $days;

    // public function mount($cars, $days, $booking)
    // {
    //     $this->cars = $cars;
    //     $this->days = $days;
    //     $this->booking = $booking;
    // }

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

    public function first_step_booking(Request $request, BookingHandlingService $bookingHandlingService)
    {
        $this->validate();

        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($this->from_date);
        $this->booking = new Booking;
        $this->booking->pick_up_id = $this->pick_up_id;
        $this->booking->drop_off_id = $this->drop_off_id;
        $this->booking->from_date = $date_and_time_of_pick_up['from_date'];
        $this->booking->to_date = $bookingHandlingService->format_to_date($this->to_date);
        $this->booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        // $booking->save();

        $cars = Car::available_cars($this->booking->from_date, $this->booking->to_date);
        $days = Carbon::parse($this->booking->from_date)->diffInDays($this->booking->to_date);
        $booking = $this->booking;
        // dd($booking);
        // return to livewire bookings component
        // return view('cars.available-cars', compact('cars', 'days', 'booking'));
        return redirect()->to('/available-cars')->with(['cars' => $cars, 'days' => $days, 'booking' => $booking]);
        // $this->emit('booking_car', $available_cars, $days, $this->booking);



        // return view('livewire.bookings')
        //     ->with([
        //         'cars' => $cars,
        //         'days' => $days,
        //         'booking' => $this->booking
        //     ]);
        // redirect to the available cars page
        // dd($this->booking);
        // return redirect('/available-cars')->with(['cars' => $cars, 'days' => $days, 'booking' => $this->booking]);
        //, compact('cars', 'days', 'booking'));
    }

    public function render()
    {
        $cars = Car::where('always_booked', false)->get();
        $locations = Location::all();

        return view('livewire.cars.available-cars', compact('cars', 'locations'));
    }
}
