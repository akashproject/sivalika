<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $table = 'media';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','type','filename','alternative','caption','description','extension','size','dimension','path','created_at'
    ];
}
