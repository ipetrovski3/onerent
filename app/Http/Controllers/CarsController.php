<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Location;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('dashboard.cars.index', compact('cars'));
    }

    public function front_show($id)
    {
        $car = Car::findOrFail($id);

        return view('front.cars.car-details', compact('car'));
    }

    public function front_index()
    {
        $cars = Car::all();
        $locations = Location::all();
        return view('front.cars.index', compact('cars', 'locations'));
    }

    public function new()
    {
        $car = new Car;
        $car_brands = CarBrand::all();
        $car_models = CarModel::all();
        return view('dashboard.cars.new')
            ->with([
                    'car_brands' => $car_brands,
                    'car_models' => $car_models,
                    'car' => $car
            ]);
    }

    public function store(CarRequest $request)
    {
        $data = $request->validated();
        $car = new Car;
        $car->car_model_id = $request->car_model_id;
        $car->plate = $this->clean_plate($request->plate);
        $car->ac = $request->ac;
        $car->navigation = $request->navigation;
        $car->transmission_type = $request->transmission_type;
        $car->engine_type = $request->engine_type;
        $car->max_passengers = $request->max_passengers;
        $car->ppd = $request->ppd;
        $car->save();

        return redirect()->route('cars.index');
    }
    public function select_brand(Request $request)
    {
        $brand = CarBrand::findOrFail($request->brand_id);
        $car_models = $brand->models;

        return view('dashboard.cars.partials.models')->with(['car_models' => $car_models])->render();
    }

    public function car_status(Request $request)
    {
        $car = Car::findOrFail($request->car_id);
        $car->update(['always_booked' => $request->status]);
    }

    private function clean_plate($plate)
    {
       return strtoupper(preg_replace("/[^a-zA-Z0-9]+/", "", $plate));
    }


}
