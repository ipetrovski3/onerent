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
        return $this->model->brand();
    }

    public function bookings()
    {
        return $this->hasOne(Booking::class);
    }

    public function brand_and_model()
    {
        return $this->brand->name . ' ' . $this->model->name;
    }

    public static function available_cars($from, $to)
    {
        return self::with('bookings')->whereNotIn('id', function ($query) use ($from, $to) {
            $query->from('bookings')
                ->select('car_id')
                ->whereDate('from_date', '<=', $to)
                ->whereDate('to_date', '>=', $from)
                ->where('car_id', '!=', 'id');
        })->get();
    }

    public $transmissions = [
        '0' => 'Automatic',
        '1' => 'Manual'
    ];

    public $engines = [
        '0' => 'Petrol',
        '1' => 'Diesel',
        '2' => 'LPG',
        '3' => 'Hybrid',
        '4' => 'Electric'
    ];

}
