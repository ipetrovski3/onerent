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
        $booking->from_date = $this->format_from_date()['from_date'];
        $booking->to_date = $this->format_to_date();
        $booking->time_of_pick_up = $this->format_from_date()['pick_up_time'];
        $booking->save();

        session()->flush();

        return $booking;
    }

    public function format_from_date($from)
    {
        // dd($from);
        $from_date = explode(' ', $from);
        return [
            'from_date' => Carbon::createFromFormat('m.d.yy', $from_date[0]),
            'pick_up_time' => $from_date[1]
        ];

    }

    public function format_to_date($to)
    {
        $to_date = explode(' ', $to);
        return Carbon::createFromFormat('m.d.yy', $to_date[0]);
    }
}

