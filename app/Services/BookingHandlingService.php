<?php

namespace App\Services;

use App\Models\Booking;
use Carbon\Carbon;

class BookingHandlingService
{
    public function isCarBooked($car_id, $from_date, $from_time, $to_date, $to_time)
    {
        $fromDateTime = Carbon::parse("$from_date $from_time");
        $toDateTime = Carbon::parse("$to_date $to_time");
        $bookings = Booking::where('car_id', $car_id)->get();

        foreach ($bookings as $booking) {
            $bookingStart = Carbon::parse("{$booking->from_date} {$booking->time_of_pick_up}");
            $bookingEnd = Carbon::parse("{$booking->to_date} {$booking->time_of_drop_off}");

            // Check for overlap
            if (
                ($fromDateTime >= $bookingStart && $fromDateTime < $bookingEnd) ||
                ($toDateTime > $bookingStart && $toDateTime <= $bookingEnd) ||
                ($fromDateTime <= $bookingStart && $toDateTime >= $bookingEnd)
            ) {
                return true; // There is a conflicting booking.
            }
        }

        return false; // No conflicting bookings found.
    }

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
        return [
            'to_date' => Carbon::parse($to)->format('Y-m-d'),
            'drop_off_time' => Carbon::parse($to)->format('H:i'),
        ];
    }
}
