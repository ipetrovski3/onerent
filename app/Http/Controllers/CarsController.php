<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Booking;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use App\Services\BookingHandlingService;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('dashboard.cars.index', compact('cars'));
    }

    public function show_car($car_id)
    {
        return view('cars.show-car', compact('car_id'));
    }

    public function front_index()
    {
        $cars = Car::all();
        $locations = Location::all();
        return view('front.cars.index', compact('cars', 'locations'));
    }

    public function available_cars($booking_id, BookingHandlingService $bookingHandlingService)
    {
        $booking = Booking::findOrFail($booking_id);
        $cars = Car::availableCars();
        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($booking->from_date);
        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($booking->time_of_pick_up);
        $from_date = $date_and_time_of_pick_up['from_date'];
        $from_time = $date_and_time_of_pick_up['pick_up_time'];

        $date_and_time_of_drop_off = $bookingHandlingService->format_to_date($booking->to_date);
        $date_and_time_of_drop_off = $bookingHandlingService->format_to_date($booking->time_of_drop_off);
        $to_date = $date_and_time_of_drop_off['to_date'];
        $to_time = $date_and_time_of_drop_off['drop_off_time'];

        foreach ($cars as $key => $car) {
            // if car is booked for the same period, remove it from the list
            if ($bookingHandlingService->isCarBooked($car->id, $from_date, $from_time, $to_date, $to_time)) {
                unset($cars[$key]);
            }
        }

        $days = Carbon::parse($booking->from_date)->diffInDays($booking->to_date);

        return view('cars.available-cars', compact('cars', 'days', 'booking'));
    }

    public function new()
    {
        $car = new Car;
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        return view('dashboard.cars.new')
            ->with([
                    'car_brands' => $car_brands,
                    'car_models' => $car_models,
                    'car' => $car
            ]);
    }

    public function store(CarRequest $request)
    {
        $data = $request->validated();
        $car = new Car;
        $car->car_model_id = $request->car_model_id;
        $car->plate = $this->clean_plate($request->plate);
        $car->ac = $request->ac;
        $car->navigation = $request->navigation;
        $car->transmission_type = $request->transmission_type;
        $car->engine_type = $request->engine_type;
        $car->max_passengers = $request->max_passengers;
        $car->ppd = $request->ppd;
        $car->save();

        return redirect()->route('cars.index');
    }

    public function select_brand(Request $request)
    {
        $brand = CarBrand::findOrFail($request->brand_id);
        $car_models = $brand->models;

        return view('dashboard.cars.partials.models')->with(['car_models' => $car_models])->render();
    }

    public function car_status(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car->update(['always_booked' => $request->status]);
    }

    public function set_dates(Request $request)
    {
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        session()->put(['from_date' => $from_date, 'to_date' => $to_date]);

        $cars = Car::whereDoesntHave('bookings', function ($query) use ($from_date, $to_date) {
            $query->where('from_date', '<=', $from_date)
                ->where('to_date', '>=', $to_date);
        })->get();

        return view('front.cars.free_cars')->with(['cars' => $cars])->render();
    }

    public function car_booked_days(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $booked_days = $this->booked_days($car);

        return $booked_days;
    }

    public function update_car_price(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car->update(['ppd' => $request->price]);
    }

    // private function clean_plate($plate)
    // {
    //    return strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $plate));
    // }

    private function booked_days($car)
    {
        $booked_days = $car->bookings->map(function ($booking) {
            return [
                'from_date' => Carbon::parse($booking->from_date)->format('Y-m-d'),
                'to_date' => Carbon::parse($booking->to_date)->format('Y-m-d'),
            ];
        });

        // convert all booked days with the days in between in one array
        foreach ($booked_days as $key => $booked_day) {
            $booked_days[$key] = $this->getDatesFromRange($booked_day['from_date'], $booked_day['to_date']);
        }

        return $booked_days->flatten()->toArray();
    }

    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        $array = array();
        $interval = new \DateInterval('P1D');

        $realEnd = new \DateTime($end);
        $realEnd->add($interval);

        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }
}
