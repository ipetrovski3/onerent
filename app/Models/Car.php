<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function model()
    {
        return $this->belongsTo(CarModel::class, 'car_model_id');
    }

    public function brand()
    {
        return $this->model->brand;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function brand_and_model()
    {
        return $this->model->brand->name . ' ' . $this->model->name; // Access brand through model relationship
    }

    public static function available_cars($from, $to)
    {
        return self::with(['bookings' => function ($query) use ($from, $to) {
            $query->whereDate('from_date', '<=', $to)
                ->whereDate('to_date', '>=', $from);
        }])
        ->where('always_booked', false)
        ->get()
        ->filter(function ($car) {
            return $car->bookings->isEmpty();
        });
    }

    public static function transmissions()
    {
        return [
            '0' => 'Automatic',
            '1' => 'Manual',
        ];
    }

    public static function engines()
    {
        return [
            '0' => 'Petrol',
            '1' => 'Diesel',
            '2' => 'LPG',
            '3' => 'Hybrid',
            '4' => 'Electric',
        ];
    }
}

