<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','size','person','room_count','amenities','featured_image','status','created_at',
    ];
}