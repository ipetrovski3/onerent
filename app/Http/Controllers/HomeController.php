<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\GoogleReview;
use App\Models\Location;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cars = Car::where('always_booked', false)->get();
        $locations = Location::all();
        $googleReviews = GoogleReview::inRandomOrder()->get();
        if ($googleReviews->count() < 6) {
            $googleReviews = $googleReviews->concat($googleReviews);
        }
        return view('index')->with([
            'cars' => $cars,
            'locations' => $locations,
            'googleReviews' => $googleReviews
        ]);
    }

    public function booking()
    {
        $cars = Car::with('bookings')->get();
        return $cars;
    }
}
