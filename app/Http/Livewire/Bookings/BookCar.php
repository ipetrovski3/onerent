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
    public $pick_up;
    public $drop_off;
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
    public $terms_and_conditions = false;

    public function mount($cars, $days, $booking)
    {
        if ($cars->count() == 0) {
            $this->cars = null;
        } else {
            $this->cars = $cars;
        }

        $this->days = $days;
        $this->booking = $booking;
        $this->pick_up = Location::find($booking['pick_up_id']);
        $this->drop_off = Location::find($booking['drop_off_id']);
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
            'terms_and_conditions' => 'accepted'
        ];
    }

    protected $messages = [
        'first_name.required' => 'First Name is required',
        'last_name.required' => 'Last Name is required',
        'email.required' => 'Email is required',
        'email.email' => 'Email is not valid',
        'phone.required' => 'Phone is required',
        'personal_id.required' => 'Personal ID is required',
        'address.required' => 'Address is required',
        'country.required' => 'Country is required',
        'terms_and_conditions.accepted' => 'Please accept terms and conditions'
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
