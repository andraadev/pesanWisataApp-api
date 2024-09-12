<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // protected $fillable
    protected $fillable = [
        'booking_date',
        'user_id',
        'destination_id',
        'status'
    ];
}
