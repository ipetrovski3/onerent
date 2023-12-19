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

    // scope for available cars
    public function scopeAvailableCars($query)
    {
        return $query->where('always_booked', false)->get();
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

