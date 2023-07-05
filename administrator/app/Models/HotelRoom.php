<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelRoom extends Model
{
    use HasFactory;
    protected $table = 'hotel_rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','hotel_id','room_id','hotel_room_no','status','created_at',
    ];
}
