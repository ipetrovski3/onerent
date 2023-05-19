<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;

class BookingHandlingService
{
    public function make_reservation()
    {
        $booking = new Booking;
        $booking->pick_up_id = session()->get('pick_up_id');
        $booking->drop_off_id = session()->get('drop_off_id');
        $booking->from_date = $this->format_from_date('from_date');
        $booking->to_date = $this->format_to_date('to_date');
        $booking->time_of_pick_up = $this->format_from_date('pick_up_time');
        $booking->save();

        session()->flush();

        return $booking;
    }

    public function format_from_date($from)
    {
        return [
            'from_date' => Carbon::parse($from)->format('Y-m-d'),
            'pick_up_time' => Carbon::parse($from)->format('H:i'),
        ];
    }

    public function format_to_date($to)
    {
        return Carbon::parse($to)->format('Y-m-d');
    }
}
