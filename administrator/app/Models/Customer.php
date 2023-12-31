<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','email','mobile','dob','gender','marital_status','created_at',
    ];
}