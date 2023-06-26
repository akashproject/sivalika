<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedRooms extends Model
{
    use HasFactory;
    protected $table = 'reserved_rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','booking_id','room_id','total_room_book','created_at',
    ];
}
