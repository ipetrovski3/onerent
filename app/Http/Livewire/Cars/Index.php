<?php

namespace App\Http\Livewire\Cars;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\User;
use App\Models\Client;
use App\Models\Booking;
use App\Models\Country;
use Livewire\Component;
use App\Models\Location;
use App\Jobs\NewBookingJob;
use App\Mail\AdminNewBooking;
use App\Mail\NewBookingEmail;
use App\Services\SendEmailsService;
use Illuminate\Support\Facades\Mail;
use App\Services\BookingHandlingService;

class Index extends Component
{
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
    public $total_price;

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
            'from_date' => 'required',
            'to_date' => 'required',
            'pick_up' => 'required',
            'drop_off' => 'required'
        ];
    }

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
    }

    public function bookCar($car_id)
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
        $booking = new Booking;
        $booking->car_id = $car_id;
        $booking->client_id = $client->id;
        $booking->pick_up_id = $this->pick_up;
        $booking->drop_off_id = $this->drop_off;
        $booking->from_date = $date_and_time_of_pick_up['from_date'];
        $booking->to_date = $bookingHandlingService->format_to_date($this->to_date);
        $booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        $booking->save();

        // $admin_email = User::first()->email;
        // $for_client = $this->email_content('client', $client, $booking);
        // Mail::to($admin_email)->queue(new AdminNewBooking($client, $booking));
        // Mail::to($client->email)->queue(new NewBookingEmail($for_client));

        NewBookingJob::dispatch($client, $booking);

        // $sendEmailsService = new SendEmailsService;
        // $sendEmailsService->send_emails($admin_email, $client->email, $booking, $client);

        return redirect()->route('home')->with(['success' => 'Your Booking was successfully']);
    }

    public function render()
    {
        $cars = Car::all();
        $locations = Location::all();
        $countries = Country::all();
        $transmissions = Car::transmissions();
        $engines = Car::engines();

        return view('livewire.cars.index', compact('cars', 'locations', 'countries', 'transmissions', 'engines'));
    }
}
