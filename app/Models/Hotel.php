<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotels';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','title','slug','featured_image','excerpt','description','amenities','address','gmap','state_id','city_id','lat','lng','meta_description','schema','robots','utm_campaign','utm_source','status','created_at',
    ];
}
