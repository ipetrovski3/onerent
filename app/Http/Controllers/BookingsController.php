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
        // dd($request->all());
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

        $date_and_time_of_pick_up = $bookingHandlingService->format_from_date($request->from_date);
        $booking = new Booking;
        $booking->pick_up_id = $request->pick_up_id;
        $booking->drop_off_id = $request->drop_off_id;
        $booking->from_date = $date_and_time_of_pick_up['from_date'];
        $booking->to_date = $bookingHandlingService->format_to_date($request->to_date);
        $booking->time_of_pick_up = $date_and_time_of_pick_up['pick_up_time'];
        $booking->save();

        $cars = Car::available_cars($booking->from_date, $booking->to_date);
        $days = $booking->from_date->diffInDays($booking->to_date);

        return view('front.cars.available_cars')
            ->with([
                'cars' => $cars,
                'days' => $days,
                'booking' => $booking
            ]);
    }

    public function by_car()
    {
        $cars = Car::with('bookings')->whereHas('bookings')->get();

        return view('dashboard.bookings.by_car', compact('cars'));
    }

}
