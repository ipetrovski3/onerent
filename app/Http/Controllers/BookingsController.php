<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingsController extends Controller
{

    public function index()
    {
        $bookings = Booking::all();
        return view('dashboard.bookings.index', compact('bookings'));
    }

    public function first_step_booking(Request $request)
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

        $with_time = explode(' ', $request->from_date);
        $from_time = explode(' ', $request->to_date);
        $from = Carbon::createFromFormat('m/d/yy', $with_time[0]);
        $to = Carbon::createFromFormat('m/d/yy', $from_time[0]);

        $booking = new Booking;
        $booking->pick_up_id = $request->pick_up_id;
        $booking->drop_off_id = $request->drop_off_id;
        $booking->from_date = $from;
        $booking->to_date = $to;
        $booking->time_of_pick_up = $with_time[1];
        $booking->save();

        $cars = Car::with('bookings')->whereNotIn('id', function ($query) use ($from, $to) {
            $query->from('bookings')
                ->select('car_id')
                ->whereDate('from_date', '<=', $to)
                ->whereDate('to_date', '>=', $from)
                ->where('car_id', '!=', 'id');
        })->get();

        $days = $from->diffInDays($to);
        return view('front.cars.available_cars')
            ->with([
                'cars' => $cars,
                'booking' => $booking,
                'days' => $days
            ]);

    }

    public function by_car()
    {
        $cars = Car::with('bookings')->whereHas('bookings')->get();

        return view('dashboard.bookings.by_car', compact('cars'));
    }

    public function calendar($date = null)
    {
        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

        $html = '<div class="calendar">';

        $html .= '<div class="month-year">';
        $html .= '<span class="month">' . $date->format('M') . '</span>';
        $html .= '<span class="year">' . $date->format('Y') . '</span>';
        $html .= '</div>';

        $html .= '<div class="days">';

        $dayLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        foreach ($dayLabels as $dayLabel)
        {
            $html .= '<span class="day-label">' . $dayLabel . '</span>';
        }

        while($startOfCalendar <= $endOfCalendar)
        {
            $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
            $extraClass .= $startOfCalendar->isToday() ? ' today' : '';

            $html .= '<span class="day '.$extraClass.'"><span class="content">' . $startOfCalendar->format('j') . '</span></span>';
            $startOfCalendar->addDay();
        }
        $html .= '</div></div>';
        return $html;
    }
}
