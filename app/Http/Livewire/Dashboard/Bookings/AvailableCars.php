<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\BookingHandlingService;

class AvailableCars extends Component
{
    public $booking;

    public function first_step_booking(Request $request, BookingHandlingService $bookingHandlingService)
    {
        $request->validate(
            [
                'pick_up_id' => 'required',
                'drop_off_id' => 'required',
                'from_date' => 'required',
                'to_date' => 'required',
            ],
            [
                'pick_up_id.required' => 'Please specify pick up location',
                'drop_off_id.required' => 'Please specify drop off location',
                'from_date.required' => 'Please add start date',
                'to_date.required' => 'Please add end_date',
            ]
        );

        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($request->from_date);
        $this->booking = new Booking;
        $this->booking->pick_up_id = $request->pick_up_id;
        $this->booking->drop_off_id = $request->drop_off_id;
        $this->booking->from_date = $date_and_time_of_pick_up['from_date'];
        $this->booking->to_date = $bookingHandlingService->format_to_date($request->to_date);
        $this->booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        // $booking->save();

        $cars = Car::available_cars($this->booking->from_date, $this->booking->to_date);
        $days = Carbon::parse($this->booking->from_date)->diffInDays($this->booking->to_date);

        return view('front.cars.available_cars')
            ->with([
                'cars' => $cars,
                'days' => $days,
                'booking' => $this->booking
            ]);
    }

    public function render()
    {
        $cars = Car::where('always_booked', false)->get();
        $locations = Location::all();
        return view('livewire.dashboard.bookings.available-cars', compact('cars', 'locations'));
    }
}
