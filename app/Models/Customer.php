<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','email','passcode','mobile','dob','gender','marital_status','created_at',
    ];

    protected $hidden = [
        'passcode'
    ];


    public function getAuthPassword()
    {
      return $this->passcode;
    }

    public function generateOtp()
    {
        return mt_rand(100000, 999999);
    }

}