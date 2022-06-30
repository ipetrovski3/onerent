<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarModelRequest;
use App\Models\CarBrand;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CarModelsController extends Controller
{
    public function new()
    {
        $brands = CarBrand::all();
        return view('dashboard.models.new', compact('brands'));
    }

    public function store(CarModelRequest $request)
    {
        $validated = $request->validated();

        $model = new CarModel;
        $model->name = $request->name;
        $model->car_brand_id = $request->car_brand_id;
        $request->file('image')->store('cars', 'public');
        $model->image = $request->file('image')->hashName();
        $model->save();

        return redirect()->back();
    }
}
