<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use App\Models\Booking;
use Livewire\Component;

class Index extends Component
{
    public $bookingId;

    public function getBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function deleteBooking()
    {
        $booking = Booking::findOrFail($this->bookingId);
        $booking->delete();
        $this->bookingId = '';
    }

    public function render()
    {
        $bookings = Booking::where('car_id', '!=', 0)->orderBy('id', 'desc')->paginate(10);

        return view('livewire.dashboard.bookings.index', compact('bookings'));
    }
}
