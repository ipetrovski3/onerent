<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'car_id',
        'status',
        'pick_up_id',
        'drop_off_id',
        'from_date',
        'to_date',
        'time_of_pick_up',
        'time_of_drop_off',
    ];

    public function pick_up()
    {
        return $this->belongsTo(Location::class, 'pick_up_id');
    }

    public function drop_off()
    {
        return $this->belongsTo(Location::class, 'drop_off_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public $statuses = ['pending', 'confirmed', 'canceled'];

    public function getFromDateAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }

    public function getToDateAttribute($value)
    {
        return date('d.m.Y', strtotime($value));
    }
}
