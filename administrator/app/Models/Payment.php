<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','booking_id','order_id','payment_id','payment_type','payment','amount'
    ];
}