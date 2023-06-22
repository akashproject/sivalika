<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','hotel_id','user_id','guest_name','guest_mobile','amount','total_guest','rooms','checkin','checkout','order_id','payment_id','payment','status','created_at',
    ];
}