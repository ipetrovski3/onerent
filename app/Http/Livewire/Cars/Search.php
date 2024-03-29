<?php

namespace App\Http\Livewire\Cars;

use Carbon\Carbon;
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

    protected function rules()
    {
        return [
            'pick_up_id' => 'required',
            'drop_off_id' => 'required',
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
        ];
    }

    protected $messages = [
        'pick_up_id.required' => 'Please specify pick up location',
        'drop_off_id.required' => 'Please specify drop off location',
        'from_date.required' => 'Please add start date',
        'to_date.required' => 'Please add end date',
        'from_date.after_or_equal' => 'Start date must be after or equal to today',
        'to_date.after_or_equal' => 'End date must be after or equal to start date'
    ];

    public function availableCars(BookingHandlingService $bookingHandlingService)
    {
        $this->validate();

        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($this->from_date);
        $from_date = $date_and_time_of_pick_up['from_date'];
        $from_time = $date_and_time_of_pick_up['pick_up_time'];

        $date_and_time_of_drop_off = $bookingHandlingService->format_to_date($this->to_date);
        $to_date = $date_and_time_of_drop_off['to_date'];
        $to_time = $date_and_time_of_drop_off['drop_off_time'];

        // check if from_time is greater than now
        if ($from_date == now()->format('Y-m-d') && $from_time < now()->format('h:i')) {
            $this->addError('from_date', 'Pick up time must be greater than now');
            return;
        } elseif ($from_date == $to_date && $from_time >= $to_time) {
            $this->addError('to_date', 'Drop off time must be greater than pick up time');
            return;
        }

        $this->booking = new Booking;
        $this->booking->pick_up_id = $this->pick_up_id;
        $this->booking->drop_off_id = $this->drop_off_id;
        $this->booking->from_date = $date_and_time_of_pick_up['from_date'];
        $this->booking->to_date = $date_and_time_of_drop_off['to_date'];
        $this->booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        $this->booking->time_of_drop_off = $date_and_time_of_drop_off['drop_off_time'];
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
