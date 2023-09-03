<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use Carbon\Carbon;
use App\Models\Car;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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
                    ->get();

                // Initialize availability and client name
                $availability = 'green'; // Default to available
                $clientName = '';

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
                }
                // Add availability and client name to the array
                $clientName ?? $clientName = '';
                $availabilityArray[] = [
                    'availability' => $availability,
                    'clientName' => $clientName,
                ];
            }
            $this->cars[] = [
                'model' => $car->brand_and_model(),
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
                    ->get();

                $availability = 'green'; // Default to available
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
                }
                // Add availability and client name to the array
                $clientName ?? $clientName = '';
                $availabilityArray[] = [
                    'availability' => $availability,
                    'clientName' => $clientName,
                ];
            }
            $this->cars[] = [
            'model' => $car->brand_and_model(),
            'availability' => $availabilityArray,
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashboard.bookings.car-availability');
    }
}
