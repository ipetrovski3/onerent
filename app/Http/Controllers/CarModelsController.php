<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarModelRequest;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelsController extends Controller
{
    public function store(CarModelRequest $request)
    {
        $validated = $request->validated();

        CarModel::create($validated);
    }
}
