<?php

use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Facades\Agent;
use App\Models\State;
use App\Models\City;
use App\Models\Media;
use App\Models\Setting;
use App\Models\Review;
use App\Models\Faq;
use App\Models\Room;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

if (! function_exists('check_device')) {
    function check_device($param = null){
        $device = "";
        switch ($param) {
            case 'desktop':
                $device = Agent::isDesktop();
                break;
            case 'tablet':
                $device = Agent::isTablet();
            case 'mobile':
                $device = Agent::isPhone();
                break;
            case 'os':
                $device = Agent::device();
                break;
        }
        
        return $device;
    }
}

if (! function_exists('getSizedImage')) {
    function getSizedImage($size = '',$id) {
        $size = ($size)?$size.'_':"";
        $media = DB::table('media')->where('id',$id)->first();
       
        if($media){
            return $filename = env('APP_URL').$media->path.'/'.$size.$media->filename;
        } else {
            return false;
        }
    }
}

if (! function_exists('getAttachmentUrl')) {
    function getAttachmentUrl($id) {
        $media = DB::table('media')->where('id',$id)->first();
        if($media){
            return $filename = env('APP_URL').$media->path.'/'.$media->filename;
        } else {
            return false;
        }
    }
}

if (! function_exists('thousandsCurrencyFormat')) {
    function thousandsCurrencyFormat($num) {
        if($num>1000) {
            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }
        return $num;
    }
}

if (! function_exists('get_theme_setting')) {
    function get_theme_setting($value){
        $media = Setting::where('key',$value)->first();
        return (isset($media->value))?$media->value:"null";
    }
}

if (! function_exists('get_user_meta')) {
    function get_user_meta($key){
        $user = Auth::user();
        $meta = DB::table('user_meta')->where('user_id',$user->id)->where('meta_key',$key)->first();
        return (isset($meta->meta_value))?$meta->meta_value:"null";
    }
}

if (! function_exists('get_rooms')) {
    function get_rooms($hotel_id){
        $room = DB::table('rooms');
        
        if($hotel_id){
            $room->where('hotel_id',$hotel_id);
        } 

        $room = $room->where('status',"1")->get();
        return $room;
    }
}

if (! function_exists('get_customer_by_id')) {
    function get_customer_by_id($id){
        $customer = Customer::where('id',$id)->first();
        return (isset($customer->id))?$customer:"null";
    }
}

if (! function_exists('get_room_by_id')) {
    function get_room_by_id($value){
        $room = Room::where('id',$value)->first();
        return (isset($room->id))?$room:"null";
    }
}

if (! function_exists('get_reviews_ratings')) {
    function get_reviews_ratings($model="",$model_id=""){
        $reviews = DB::table('reviews');
        if($model){
            $reviews->where('model',$model);
        } 
        if($model_id){
            $reviews->where('model_id',$model_id);
        } 
        $reviews->where('status',"1");     
        $reviews = $reviews->paginate(10);;   
                           
        $total = $reviews->sum('rating');

        if(count($reviews) <= 0){
            return false;
        }
        
        $avg = number_format((float)$total/count($reviews), 1, '.', '');

        $ratingvalue = array();
        foreach ($reviews as $key => $review) {
            $ratingvalue[] = $review->rating;
        }
        $ratingvalue = array_count_values($ratingvalue);

        $ratings = array();
        for ($i=5; $i >= 1; $i--) { 
            $ratings[$i] = (array_key_exists($i, $ratingvalue))?$ratingvalue[$i]:"0";
        }
        $reviewRatings = array(
            'reviews' => $reviews,
            'avarageRating' =>$avg,
            'reviewCount' => count($reviews),
            'ratings' => $ratings
        );
        return $reviewRatings;
    }
}

if (! function_exists('getFaqs')) {
    function getFaqs($model=null,$model_id=null,$limit=10){
        $faq = DB::table('faqs');
        
        if($model){
            $faq->where('model', 'like', '%"' . $model . '"%');
        } 
        if($model_id){
            $faq->where('model_id',$model_id);
        }   

        $faq = $faq->where('status',"1")->paginate($limit);
        return $faq;
    }
}

if (! function_exists('getStates')) {
    function getStates(){
        try {
            $states = State::where('status', 1)->orderBy("name","asc")->get();
            return $states;
        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }
    }
}

if (! function_exists('getStateById')) {
    function getStateById($id){
        try {
            $state = State::findOrFail($id);
            return $state;
        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }
    }
}

if (! function_exists('getCityById')) {
    function getCityById($id){
        try {
            $city = DB::table('cities')->where('id',$id)->first();
            return $city;
        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }
    }
}

if (! function_exists('getRadius')) {
    function getRadius($lat,$lon){
        try {
            $R = 3960;  // earth's mean radius
            $rad = '1000';
            // first-cut bounding box (in degrees)
            $maxLat = $lat + rad2deg($rad/$R);
            $minLat = $lat - rad2deg($rad/$R);
            // compensate for degrees longitude getting smaller with increasing latitude
            $maxLon = $lon + rad2deg($rad/$R/cos(deg2rad($lat)));
            $minLon = $lon - rad2deg($rad/$R/cos(deg2rad($lat)));

            $radies = array(
                'lat' => $lat,
                'lon' => $lon,
                'maxLat' => number_format((float)$maxLat, 6, '.', ''),
                'minLat' => number_format((float)$minLat, 6, '.', ''),
                'maxLon' => number_format((float)$maxLon, 6, '.', ''),
                'minLon' => number_format((float)$minLon, 6, '.', ''),
            );
            return $radies;
        } catch(\Illuminate\Database\QueryException $e){
            throw $e;
        }
    }
}

if (! function_exists('getUtmCampaign')) {
    function getUtmCampaign($params = null){
        if(request()->has('utm_campaign')){
            return request()->get('utm_campaign');
        }
        return ($params)?$params:get_theme_setting('utm_campaign');
    }
}

if (! function_exists('getUtmSource')) {
    function getUtmSource($params = null){
        if(request()->has('utm_source')){
            return request()->get('utm_source');
        }
        return ($params)?$params:get_theme_setting('utm_source');
    }
}

if (! function_exists('getCommunicationMedium')) {
    function getCommunicationMedium($params = null){
        if(request()->has('lead_type')){
            return request()->get('lead_type');
        }
        return ($params)?$params:get_theme_setting('lead_type');
    }
}

if (! function_exists('getTotalGuest')) {
    function getTotalGuest($params = null){
        $person = 0;
        foreach ($params as $rt => $roomType) {
            if ($roomType) {
                foreach ($roomType as $t => $room) {
                    $person += $room['adult'];
                }
            }
        }
        return $person;
    }
}

if (! function_exists('get_booking_meta')) {
    function get_booking_meta($id, $key){
        $meta = DB::table('booking_meta')->where('booking_id',$id)->where('meta_key',$key)->first();
        return (isset($meta->meta_value))?$meta->meta_value:"null";
    }
}

if (! function_exists('get_booking_meta_row')) {
    function get_booking_meta_row($id, $key){
        return $meta = DB::table('booking_meta')->where('booking_id',$id)->where('meta_key',$key)->first();
    }
}

function numberToWords($number) {
    $thousands = ["", "thousand", "million", "billion"];

    $words = [];

    if ($number == 0) {
        return "zero";
    }

    for ($i = 0; $number > 0; $i++) {
        if ($number % 1000 != 0) {
            $words[] = numberToWordsHelper($number % 1000) . ' ' . $thousands[$i];
        }
        $number /= 1000;
    }

    return implode(' ', array_reverse($words));
}

function numberToWordsHelper($number) {
    $units = ["", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine"];
    $teens = ["", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen", "seventeen", "eighteen", "nineteen"];
    $tens = ["", "ten", "twenty", "thirty", "forty", "fifty", "sixty", "seventy", "eighty", "ninety"];
    $thousands = ["", "thousand", "million", "billion"];


    $words = [];

    if ($number >= 100) {
        $words[] = $units[floor($number / 100)] . ' hundred';
        $number %= 100;
    }

    if ($number >= 11 && $number <= 19) {
        $words[] = $teens[$number - 10];
    } elseif ($number >= 20) {
        $words[] = $tens[floor($number / 10)];
        $number %= 10;
    }

    if ($number > 0) {
        $words[] = $units[$number];
    }

    return implode(' ', $words);
}