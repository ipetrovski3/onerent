<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'personal_id', 'address'];
    use HasFactory;

    public function full_name()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
