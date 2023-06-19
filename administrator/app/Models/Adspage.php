<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adspage extends Model
{
    use HasFactory;
    protected $table = 'adpages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','course_type_id','center_id','name','slug','banner_image','description','template','title','enable_otp','meta_description','schema','robots','canonical','utm_campaign','utm_source','lead_type','status','created_at',
    ];
}