<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','hotel_id','name','size','person','room_count','amenities','featured_image','cost','status','created_at',
    ];
}