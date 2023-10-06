<?php

namespace App\Http\Livewire\Cars;

use App\Models\Car;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Country;
use Livewire\Component;
use App\Models\Location;
use App\Jobs\NewBookingJob;
use App\Services\BookingHandlingService;

class ShowCar extends Component
{
    public $car;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $personal_id;
    public $address;
    public $country;
    public $from_date;
    public $to_date;
    public $pick_up;
    public $drop_off;
    public $car_id;
    public $selected_car;
    public $terms_and_conditions = false;
    public $booked;

    public function mount($car_id)
    {
        $this->car = Car::findOrFail($car_id);
    }

    protected function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'personal_id' => 'required',
            'address' => 'required',
            'country' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required',
            'from_date' => 'required|after_or_equal:today',
            'to_date' => 'required|after_or_equal:from_date',
            'terms_and_conditions' => 'accepted'
        ];
    }

    protected $messages = [
        'pick_up_id.required' => 'Please specify pick up location',
        'drop_off_id.required' => 'Please specify drop off location',
        'from_date.required' => 'Please add start date',
        'to_date.required' => 'Please add end date',
        'from_date.after_or_equal' => 'Start date must be after or equal to today',
        'to_date.after_or_equal' => 'End date must be after or equal to start date',
        'terms_and_conditions.accepted' => 'Please accept terms and conditions'
    ];

    public function carInfo($car_id)
    {
        $this->car_id = $car_id;
        $this->selected_car = Car::findOrFail($car_id);
    }

    public function bookCar()
    {
        $this->validate();

        $client = new Client;
        $client->first_name = $this->first_name;
        $client->last_name = $this->last_name;
        $client->email = $this->email;
        $client->phone = $this->phone;
        $client->personal_id = $this->personal_id;
        $client->address = $this->address;
        $client->country_id = $this->country;
        $client->save();

        $bookingHandlingService = new BookingHandlingService;
        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($this->from_date);
        $from_date = $date_and_time_of_pick_up['from_date'];
        $from_time = $date_and_time_of_pick_up['pick_up_time'];

        $date_and_time_of_drop_off = $bookingHandlingService->format_to_date($this->to_date);
        $to_date = $date_and_time_of_drop_off['to_date'];
        $to_time = $date_and_time_of_drop_off['drop_off_time'];

        // check if from_time is greater than now
        if ($from_date == now()->format('Y-m-d') && $from_time < now()->format('h:i')) {
            $this->addError('booked', 'Pick up time must be greater than now');
            return;
        }

        // check if car is booked for the same period
        if (!$bookingHandlingService->isCarBooked($this->car_id, $from_date, $from_time, $to_date, $to_time)) {
            $booking = new Booking;
            $booking->car_id = $this->car_id;
            $booking->client_id = $client->id;
            $booking->pick_up_id = $this->pick_up;
            $booking->drop_off_id = $this->drop_off;
            $booking->from_date = $from_date;
            $booking->to_date = $to_date;
            $booking->time_of_pick_up = $from_time;
            $booking->time_of_drop_off = $to_time;
            $booking->save();
        } else {
            $this->addError('booked', 'This car is already booked for the same period');
            return;
        }

        NewBookingJob::dispatch($client, $booking);

        return redirect()->route('home')->with(['success' => 'Your Booking was successfully']);
    }

    public function render()
    {
        $locations = Location::all();
        $countries = Country::all();
        $transmissions = Car::transmissions();
        $engines = Car::engines();

        return view('livewire.cars.show-car', compact('locations', 'countries', 'transmissions', 'engines'));
    }
}
