<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use App\Models\Car;
use Livewire\Component;
use App\Models\CarModel;
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
    
        foreach ($cars as $car) {
            $availabilityArray = [];
            for ($day = 1; $day <= $this->daysInMonth; $day++) {
                $date = now()->setDay($day)->toDateString();
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
                }
    
                $availabilityArray[] = $availability;
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
    }

    public function previousMonth()
    {
        $this->updateAvailability(date('n') - 1, date('Y'));
        $this->selectedMonth = date('n') - 1;
    }

    private function updateAvailability($month, $year)
    {
        // Clear the existing availability data
        foreach ($this->cars as &$car) {
            $car['availability'] = [];
        }

        // Calculate the number of days in the new month
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        foreach ($this->cars as &$car) {
            $availabilityArray = [];
            $carBrandAndModel = $car['model'];

            // Separate the brand and model names
            [$brand, $model] = explode(' ', $carBrandAndModel);

            // Fetch cars based on brand and model names
            $matchingCars = Car::whereHas('model.brand', function ($query) use ($brand) {
                $query->where('name', $brand);
            })->whereHas('model', function ($query) use ($model) {
                $query->where('name', $model);
            })->get();

            foreach ($matchingCars as $matchingCar) {
                $carId = $matchingCar->id;

                for ($day = 1; $day <= $daysInMonth; $day++) {
                    $date = $year . '-' . $month . '-' . $day;
                    
                    // Check if the car is booked for the specific day
                    $isBooked = DB::table('bookings')
                        ->where('car_id', $carId)
                        ->whereDate('from_date', '<=', $date)
                        ->whereDate('to_date', '>=', $date)
                        ->count() > 0;

                    // Mark the day as available if not booked, otherwise mark it as booked
                    $availabilityArray[] = !$isBooked ? 'green' : 'red';
                }
            }
            $car['availability'] = $availabilityArray;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.bookings.car-availability');
    }
}
