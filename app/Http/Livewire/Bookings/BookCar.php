<?php

namespace App\Http\Livewire\Bookings;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Country;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Services\SendEmailsService;
use App\Services\BookingHandlingService;

class BookCar extends Component
{
    public $booking = [];
    public $pick_up_id = '';
    public $drop_off_id = '';
    public $from_date;
    public $to_date;
    public $cars;
    public $days;
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $personal_id;
    public $address;
    public $country;
    public $car_id;
    public $selected_car;
    public $total_price;

    public function mount($cars, $days, $booking)
    {
        $this->cars = $cars;
        $this->days = $days;
        $this->booking = $booking;
    }

    protected $rules = [
        // 'pick_up_id' => 'required',
        // 'drop_off_id' => 'required',
        // 'from_date' => 'required',
        // 'to_date' => 'required',
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'phone' => 'required',
        'personal_id' => 'required',
        'address' => 'required',
        'country' => 'required'
    ];

        // 'first_name' => 'required',
        // 'last_name' => 'required',
        // 'email' => 'required|email',
        // 'phone' => 'required',
        // 'personal_id' => 'required',
        // 'from_date' => 'required',
        // 'to_date' => 'required',
        // 'pick_up' => 'required',
        // 'drop_off' => 'required'

    protected $messages = [
        'pick_up_id.required' => 'Please specify pick up location',
        'drop_off_id.required' => 'Please specify drop off location',
        'from_date.required' => 'Please add start date',
        'to_date.required' => 'Please add end_date',
    ];

    public function carInfo($car_id)
    {
        $this->car_id = $car_id;
        $this->selected_car = Car::findOrFail($car_id);
        $this->total_price = $this->selected_car->ppd * $this->days;
    }

    public function bookCar($booking_id, $car_id)
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

        $booking = Booking::find($booking_id);
        $booking->update([
            'car_id' => $this->car_id,
            'client_id' => $client->id
        ]);

        $admin_email = User::first()->email;
        $sendEmailsService = new SendEmailsService;
        $sendEmailsService->send_emails($admin_email, $client->email, $booking, $client);

        return redirect()->route('home')->with(['success' => 'Your Booking was successfully']);

        // // if ($request->has('from_cars')) {
        // // if ($request) {
        // // $date_and_time_of_pick_up = $this->format_date($request->from_date);
        // $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($request->from_date);
        // $booking = new Booking;
        // $booking->pick_up_id = $request->pick_up;
        // $booking->drop_off_id = $request->drop_off;
        // $booking->from_date = $date_and_time_of_pick_up['from_date'];
        // $booking->to_date = $bookingHandlingService->format_to_date($request->to_date);
        // $booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        // $booking->save();
        // // }
        // // else {
        // //     $booking = Booking::find($request->booking_id);
        // // }

        // $car_id = $request->car_id;

        // $client = Client::create($request->all());
        // $booking->update(['client_id' => $client->id, 'car_id' => $car_id]);
        // $admin_email = User::first()->email;
        // $this->send_emails($admin_email, $client->email, $booking, $client);

        // return redirect()->route('home')->with(['success' => 'Your Booking was successfully']);
    }

    public function render()
    {
        // $cars = Car::where('always_booked', false)->get();
        $locations = Location::all();
        $countries = Country::all();
        $transmissions = Car::transmissions();
        $engines = Car::engines();

        return view('livewire.bookings.book-car', compact('locations', 'countries', 'transmissions', 'engines'));
    }
}
