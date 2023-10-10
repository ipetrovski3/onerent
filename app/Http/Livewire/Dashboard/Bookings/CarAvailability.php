<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Client;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use App\Services\BookingHandlingService;

class CarAvailability extends Component
{
    public $daysInMonth;
    public $cars = [];
    public $selectedMonth;
    public $selectedYear;
    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];
    public $openBookModal = false;
    public $from_date;
    public $time_of_pick_up;
    public $to_date;
    public $time_of_drop_off;
    public $selected_car;
    public $pick_up;
    public $drop_off;
    public $locations;
    public $name;
    public $description;
    public $booked;
    public $clientCheck = '';
    public $editBooking;


    public function getListeners()
    {
        return [
            'updateCalendar' => '$refresh',
        ];
    }

    public function mount()
    {
        $this->selectedMonth = date('n');
        $this->selectedYear = date('Y');
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->selectedMonth, $this->selectedYear);
        $this->loadCarAvailability();
        $this->locations = Location::all();
    }

    public function rules()
    {
        return [
            'from_date' => 'required|after_or_equal:today',
            'to_date' => 'required|after_or_equal:from_date',
            'pick_up' => 'required',
            'drop_off' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'pick_up.required' => 'Please specify pick up location',
            'drop_off.required' => 'Please specify drop off location',
            'from_date.required' => 'Please add start date',
            'to_date.required' => 'Please add end date',
            'from_date.after_or_equal' => 'Start date must be after or equal to today',
            'to_date.after_or_equal' => 'End date must be after or equal to start date',
            'name.required' => 'Please add client name',
            'description.required' => 'Please add client address',
        ];
    }

    public function openModal()
    {
        $this->openBookModal = true;
    }

    public function closeModal()
    {
        $this->openBookModal = false;
        $this->emptyFields();
        $this->resetErrorBag();
    }

    public function updateSelectedMonth()
    {
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->selectedMonth, $this->selectedYear);
        $this->updateAvailability($this->selectedMonth, $this->selectedYear);
        $this->emit('updateCalendar');
    }    

    private function loadCarAvailability()
    {
        // Fetch all cars
        $cars = Car::all();

        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        foreach ($cars as $car) {
            $availabilityArray = [];
            for ($day = 1; $day <= $this->daysInMonth; $day++) {
                $date = now()->setDay($day)->toDateString();
                $bookings = DB::table('bookings')
                    ->where('car_id', $car->id)
                    ->where('from_date', '<=', $date)
                    ->where('to_date', '>=', $date)
                    ->orderBy('from_date', 'asc')
                    ->get();

                // Initialize availability and client name
                $availability = 'green'; // Default to available
                $clientName = '';
                $previousToDate = null;
                $bookingId = null;
                foreach ($bookings as $booking) {
                    if ($booking->from_date === $date) {
                        $availability = 'from'; // Mark as "from" date
                    }
                    if ($booking->to_date === $date) {
                        $availability = 'to'; // Mark as "to" date
                    }
                    if ($booking->from_date < $date && $booking->to_date > $date) {
                        $availability = 'red'; // Mark as booked
                    }
                    // Fetch and set the client's name
                    $client = DB::table('clients')->where('id', $booking->client_id)->first();
                    if ($client) {
                        $clientName = $client->first_name;
                    }
                    // Check to_date from previous booking with from_date for the current booking
                    if ($previousToDate === $booking->from_date) {
                        $availability = 'change'; // Mark as booked
                    }
                    $previousToDate = $booking->to_date;

                    if ($booking)
                    {
                        $bookingId = $booking->id;
                    }
                }
                // Add availability and client name to the array
                $clientName ?? $clientName = '';
                $availabilityArray[] = [
                    'availability' => $availability,
                    'clientName' => $clientName,
                    'bookingId' => $bookingId,
                ];
            }
            $this->cars[] = [
                'id' => $car->id,
                'model' => $car->brand_and_model(),
                'ppd' => $car->ppd,
                'availability' => $availabilityArray,
            ];
        }
    }

    public function nextMonth()
    {
        $this->updateAvailability(date('n') + 1, date('Y'));
        $this->selectedMonth = date('n') + 1;
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->selectedMonth, $this->selectedYear);
    }

    public function previousMonth()
    {
        $this->updateAvailability(date('n') - 1, date('Y'));
        $this->selectedMonth = date('n') - 1;
        $this->daysInMonth = cal_days_in_month(CAL_GREGORIAN, $this->selectedMonth, $this->selectedYear);
    }

    private function updateAvailability($month, $year)
    {
        // Calculate the number of days in the given month and year
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;

        // Clear existing availability data for cars
        $this->cars = [];

        // Fetch all cars
        $cars = Car::all();

        foreach ($cars as $car) {
            $availabilityArray = [];
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $date = Carbon::create($year, $month, $day)->toDateString();
                $bookings = DB::table('bookings')
                    ->where('car_id', $car->id)
                    ->where('from_date', '<=', $date)
                    ->where('to_date', '>=', $date)
                    ->orderBy('from_date', 'asc')
                    ->get();

                $availability = 'green'; // Default to available
                $clientName = '';
                $previousToDate = null;
                $bookingId = null;
                foreach ($bookings as $booking) {
                    if ($booking->from_date === $date) {
                        $availability = 'from'; // Mark as "from" date
                    }
                    if ($booking->to_date === $date) {
                        $availability = 'to'; // Mark as "to" date
                    }
                    if ($booking->from_date < $date && $booking->to_date > $date) {
                        $availability = 'red'; // Mark as booked
                    }
                    // Fetch and set the client's name
                    $client = DB::table('clients')->where('id', $booking->client_id)->first();
                    if ($client) {
                        $clientName = $client->first_name;
                    }
                    // Check to_date from previous booking with from_date for the current booking
                    if ($previousToDate === $booking->from_date) {
                        $availability = 'change'; // Mark as booked
                    }
                    $previousToDate = $booking->to_date;
                    if ($booking)
                    {
                        $bookingId = $booking->id;
                    }
                }
                // Add availability and client name to the array
                $clientName ?? $clientName = '';
                $availabilityArray[] = [
                    'availability' => $availability,
                    'clientName' => $clientName,
                    'bookingId' => $bookingId,
                ];
            }
            $this->cars[] = [
                'id' => $car->id,
                'model' => $car->brand_and_model(),
                'ppd' => $car->ppd,
                'availability' => $availabilityArray,
            ];
        }
    }

    public function bookCar($car_id)
    {
        $this->selected_car = Car::findOrFail($car_id);
        $this->openModal();
    }

    public function saveBook()
    {
        $this->validate();

        if ($this->editBooking) {
            $this->editBooking->delete();
            $client = Client::findOrFail($this->editBooking->client_id);
            $client->first_name = $this->name;
            $client->address = $this->description;
            $client->save();
        } else {
            $client = new Client;
            $client->first_name = $this->name;
            $client->last_name = 'Admin';
            $client->email = 'admin@admin.com';
            $client->phone = '1234567890';
            $client->personal_id = '1234567890';
            $client->address = $this->description;
            $client->country_id = 130;
            $client->save();
        }

        $bookingHandlingService = new BookingHandlingService;
        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($this->from_date);
        $from_date = $date_and_time_of_pick_up['from_date'];
        $from_time = $date_and_time_of_pick_up['pick_up_time'];

        $date_and_time_of_drop_off = $bookingHandlingService->format_to_date($this->to_date);
        $to_date = $date_and_time_of_drop_off['to_date'];
        $to_time = $date_and_time_of_drop_off['drop_off_time'];

        // check if from_time is greater than now
        if ($from_date == now()->format('Y-m-d') && $from_time > now()->format('h:i')) {
            $this->booked = 'Pick up time must be greater than now';
            return;
        }

        // check if car is booked for the same period
        if (!$bookingHandlingService->isCarBooked($this->selected_car->id, $from_date, $from_time, $to_date, $to_time)) {
            $booking = new Booking;
            $booking->car_id = $this->selected_car->id;
            $booking->client_id = $client->id;
            $booking->pick_up_id = $this->pick_up;
            $booking->drop_off_id = $this->drop_off;
            $booking->from_date = $from_date;
            $booking->to_date = $to_date;
            $booking->time_of_pick_up = $from_time;
            $booking->time_of_drop_off = $to_time;
            $booking->save();

            $this->closeModal();
            return redirect()->route('calendar')->with(['success' => 'Car booked successfully']);
        } else {
            $this->booked = 'This car is already booked for the same period';
        }
    }

    public function editBooking($booking_id)
    {
        $this->editBooking = Booking::findOrFail($booking_id);
        $client = Client::findOrFail($this->editBooking->client_id);
        $this->selected_car = Car::findOrFail($this->editBooking->car_id);
        $from_date = $this->editBooking->from_date;
        $from_time = $this->editBooking->time_of_pick_up;
        $to_date = $this->editBooking->to_date;
        $to_time = $this->editBooking->time_of_drop_off;
        $this->from_date = $from_date . ' ' . $from_time;
        $this->to_date = $to_date . ' ' . $to_time;        
        $this->pick_up = $this->editBooking->pick_up_id;
        $this->drop_off = $this->editBooking->drop_off_id;
        $this->name = $client->first_name;
        $this->description = $client->address;
        $this->booked = null;
        $this->openModal();
    }

    public function emptyFields()
    {
        $this->selected_car = null;
        $this->from_date = null;
        $this->to_date = null;
        $this->pick_up = null;
        $this->drop_off = null;
        $this->name = null;
        $this->description = null;
        $this->booked = null;
        $this->clientCheck = '';
        $this->editBooking = null;
    }

    public function render()
    {
        return view('livewire.dashboard.bookings.car-availability');
    }
}
