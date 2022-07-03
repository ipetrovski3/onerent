<?php

namespace App\Http\Controllers;

use App\Models\Car;
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
        $cars = Car::all();
        $locations = Location::all();
        return view('front.index')->with([
            'cars' => $cars,
            'locations' => $locations
        ]);
    }

    public function booking()
    {
        $cars = Car::with('bookings')->get();
        return $cars;
    }
}
