<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Services\BookingHandlingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        return view('dashboard.bookings.index', compact('bookings'));
    }

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
                'to_date.required' => 'Please add end_date'
            ]
        );

        foreach ($request->all() as $key => $value) {
            session([$key => $value]);
        }

        $from = $bookingHandlingService->format_from_date()['from_date'];
        $to = $bookingHandlingService->format_to_date();

        $cars = Car::available_cars($from, $to);
        $days = $from->diffInDays($to);

        return view('front.cars.available_cars')
            ->with([
                'cars' => $cars,
                'days' => $days
            ]);
    }

    public function by_car()
    {
        $cars = Car::with('bookings')->whereHas('bookings')->get();

        return view('dashboard.bookings.by_car', compact('cars'));
    }

}
