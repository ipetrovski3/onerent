<?php

namespace App\Http\Livewire\Dashboard\Bookings;

use App\Models\Booking;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        // $bookings = Booking::all()->sortByDesc('id');
        $bookings = Booking::paginate(10);

        return view('livewire.dashboard.bookings.index', compact('bookings'));
    }
}
