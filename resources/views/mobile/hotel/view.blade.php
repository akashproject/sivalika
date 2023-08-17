@extends('layouts.main')
    @section('content')
    <style>
        .outer { margin:0 auto; max-width:800px;}
        #big .item {margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
        #thumbs .item { background: #C9C9C9; line-height:70px; padding: 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; cursor: pointer; }
        #thumbs .item h1 { font-size: 18px; }
        #thumbs .current .item { background:#FF5722; }
        .owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
        .owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
        #big.owl-theme { position: relative; }
        #big.owl-theme .owl-next, #big.owl-theme .owl-prev {
            background: #3333339c;
            width: 35px;
            line-height: 38px;
            margin-top: -24px;
            position: absolute;
            text-align: center;
            top: 52%;
            border-radius: 50%;
            color: #fff;
        }
        #big.owl-theme .owl-prev { left: 10px; }
        #big.owl-theme .owl-next { right: 10px; }
        #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { }
        #thumbs .owl-item .item:before {
            content: '';
            display: block;
            background-color: rgba(38, 38, 38, 0.52);
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1;
            margin: 2px;
            border-radius: 7px;
        }
        #thumbs .owl-item.current .item:before{
         background-color: rgba(38, 38, 38, 0);
        }
        .guestCount input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
            border: none;
            width: 60px;
            background: #fff;
            color: #423c3c;
        }

        .guestCount input[type=number]::-webkit-inner-spin-button,
        .guestCount input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            appearance: textfield;
            border: none;
            width: 36px;
            background: #f1f8ff;
            color: #423c3c;
        }
    </style>
    
    <form method="post" id="proceed-to-checkout" action="{{ url('proceed-to-checkout') }}" >
        @csrf
        <!-- Booking Start -->
        <div class="container-xxl py-3">
            <div class="container">
                <div class="text-center">
                    <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                    <h3 class="mb-2"><span class="text-primary text-uppercase">{{ $hotel->name }}</span></h3>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @if($hotel->gallery)
                <div class="outer">
                    <div id="big" class="owl-carousel owl-theme">
                        @foreach(json_decode($hotel->gallery) as $thumb)
                        <div class="item">
                            <img class="img-fluid rounded w-100" src="{{ getSizedImage('',$thumb); }}">
                        </div>
                        @endforeach
                    </div>
                
                    <div id="thumbs" class="owl-carousel owl-theme">             
                        @foreach(json_decode($hotel->gallery) as $thumb)               
                        <div class="item">
                            <img class="img-fluid rounded w-100" src="{{ getSizedImage('',$thumb); }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
        <div class="container-xxl py-3">
            <div class="container">
                <div class="row g-5">                    
                    <div class="col-lg-6">
                        <div class="checkin_panel">
                            <div class="checkin_title" >
                                <h5> Get Best Offer  <a href="javascript:void(0)" class="login-btn" > Login </a></h5>
                            </div>
                            <div class="row py-3 highlights" >
                                <div class="col-md-4">
                                    <span class="" > <i class="fa fa-check-circle" aria-hidden="true"></i> Free Cancelation </span>  
                                </div>
                                <div class="col-md-4">
                                    <span class="" > <i class="fa fa-check-circle" aria-hidden="true"></i> Couple Friendly </span> 
                                </div>
                                <div class="col-md-4">
                                    <span class="" > <i class="fa fa-check-circle" aria-hidden="true"></i> Pay Later </span> 
                                </div>
                            </div>
                            <div class="row py-3 checkin_data">
                                <div class="col-md-8 mt-2" >
                                    <div class="t-datepicker">
                                        <div class="t-check-in"></div>
                                        <div class="t-check-out"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2" >
                                    <div class="form-floating">
                                        <input type="number" id="total_guest" class="form-control" id="name"  name="total_guest" placeholder="Enter total guests" value="{{ $filterData['total_guest'] }}">
                                        <label for="name">TOTAL GUEST</label>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <a class="update_booking" href="javascript:void(0)" >Modify</a>
                                <img src="{{url('assets/img/loader.gif')}}" class="checkout_loader">
                            </div>
                            <div class="checkin_content">
                                @php
                                    $cost1 = 0;
                                @endphp
                                <div class="checkin_room_selection" >
                                    <p> Our Recommandation </p>
                                    @if($rooms)
                                    <div class="review_room" > 
                                        @foreach($rooms as $typeKey => $room)
                                            @php 
                                                $roomCount = intdiv($filterData['total_guest'], $room->person);
                                                $roomCount = ($filterData['total_guest']%$room->person != 0)?$roomCount+1:$roomCount;
                                                $cost1 += $room->cost*$roomCount;
                                            @endphp	
                                            <strong> {{$roomCount}}x {{$room->name}} </strong><br>
                                            @if($room->room_count > $roomCount)
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif
                                </div>
                                <div class="checkin_amount" >
                                    <span> Total Cost</span>
                                    <h5> ₹{{$cost1*$totalDiff}} </h5>
                                    
                                    <span> Including GST & Taxes </span>
                                </div>
                            </div>
                            <div class="row g-3 checkin_data">
                                <div class="col-md-6">
                                    <a href="#selectroom" class="color-secondary" style="font-weight: 600;" > <i class="fa fa-edit"></i> Modify Selection </a>
                                </div>
                                <div class="col-md-6">
                                    <button id="book_now" type="submit" class="btn btn-success w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="submenu" >
                <ul class="submenu_content">
                    <li class="submenu_item" >
                        <a href="#selectroom" class="color-secondary"  > Select Room </a>
                    </li>
                    <li class="submenu_item" >
                        <a href="#amenities" class="color-secondary" > Amenities </a>
                    </li>
                    <li class="submenu_item" >
                        <a href="#about" class="color-secondary" > About </a>
                    </li>
                    <li class="submenu_item" >
                        <a href="#location" class="color-secondary" > Location </a>
                    </li>
                    <li class="submenu_item" >
                        <a href="#reviews" class="color-secondary" > Reviews </a>
                    </li>
                    <li class="submenu_item" >
                        <a href="#policies" class="color-secondary" > Policies </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Booking End -->
        <div class="container-xxl py-5">
            <div class="container">
                <div id="selectroom" class="row g-4 justified-center">
                    <h3 >Select Rooms </h3> 
                </div>
                <div class="row g-4 justified-center">
                    @if($rooms)
                        @php $cost = 0; @endphp
                        @foreach($rooms as $typeKey => $room)
                            @php 
                                $availableRoom = ($room->room_count > 0)?$room->room_count:0;
                                $roomCount = $filterData['total_guest']/$room->person;
                                $roomCount = ($filterData['total_guest']%$room->person != 0)?$roomCount+1:$roomCount;
                            @endphp	
                            <input type="hidden" name="rooms[{{ $room->id }}]" >
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="room-item shadow rounded overflow-hidden">
                                    <div class="position-relative">
                                        <img class="img-fluid" src="{{ getSizedImage('',$room->featured_image) }}" alt="">
                                        <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">₹{{$room->cost}}/Night</small>
                                    </div>
                                    <div class="p-4 mt-2 pb-2">
                                        <div class="d-flex justify-content-between mb-3">
                                            <h5 class="mb-0">{{$room->name}}</h5>
                                            <div class="ps-2">
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                                <small class="fa fa-star text-primary"></small>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <small class="border-end pe-3"><i class="fa fa-home text-primary me-2"></i>{{$room->size}}</small>
                                            <small class="border-end pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room->person}} Bed</small>
                                            <small class="border-end pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$availableRoom}} Left</small>
                                        </div>
                                        <div class="room_type_{{$room->id}}" >
                                            @for($i = 1; $i<=$roomCount;$i++)
                                                @if($room->room_count < 1)
                                                    @break;
                                                @endif
                                                <div class="d-flex mb-3 row" data-min="1" data-max="{{ $room->person }}">
                                                    <div class="col-md-3" >
                                                        <span> Room :</span>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="quantity-down"> <i class="fa fa-minus-circle text-primary"></i> </span>
                                                        <span class="guestCount quantity" > <input type="number" class="guestCount_input" value="{{ ($filterData['total_guest'] < $room->person)?$filterData['total_guest']:$room->person }}" name="rooms[{{$room->id}}][{{$i}}][adult]"  min="1" max="{{ $room->person }}" readonly> </span>
                                                        <span class="quantity-up"> <i class="fa fa-plus-circle text-primary"></i> </span>  Adult
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="quantity-down"> <i class="fa fa-minus-circle text-primary"></i> </span>
                                                        <span class="guestCount quantity" > <input type="number" value="0" name="rooms[{{$room->id}}][{{$i}}][child]"  min="0" max="2"> </span>
                                                        <span class="quantity-up"> <i class="fa fa-plus-circle text-primary"></i> </span>  Child
                                                    </div>
                                                    <div class="col-md-1" >
                                                        <span class="remove-room" > <i class="fa fa-trash text-primary"></i> </span>
                                                    </div>
                                                </div>
                                                @php
                                                    $cost += $room->cost;
                                                    $room->room_count-- ;
                                                    $filterData['total_guest'] -= $room->person;
                                                @endphp
                                            @endfor
                                        </div>
                                        <div class="d-flex mb-3 row">
                                            <div class="col-6">
                                                @if($room->room_count > 1)
                                                    <a class="clear_selection" data-id="room_type_{{$room->id}}" > <i class="fa fa-trash text-primary me-2"></i> Remove All</a>
                                                @endif
                                            </div>
                                            @if($availableRoom > 0)
                                            <div class="col-6">
                                                <a type="button" id="room_type_{{$room->id}}" data-max="{{$room->person}}" data-roomcount="{{ $availableRoom }}" class="addNewRoom" data-id="{{$room->id}}"> <i class="fa fa-plus text-primary me-2"></i> Add room </a>
                                            </div>
                                            @else
                                            <div class="col-6">
                                                <h5> SOLD OUT </h5>
                                            </div>
                                            @endif
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <input id="encoded_cost" type="hidden" name="amount" value="{{base64_encode($cost*$totalDiff)}}">
        <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
    </form>  
        <div class="container-xxl py-5">
            <div class="container">
                <div id="amenities" class="row g-4 justified-center">
                    <h3 > Hotel Amenities </h3> 
                </div>
                <div class="section-border form-14" >
                    <div class="row p-2">
                        @foreach(json_decode($hotel->amenities) as $key => $value)
                        <div class="col-4"  >
                            <i class="fa fa-check" aria-hidden="true"></i> {{ $value }}
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div id="about" class="row g-4 justified-center">
                    <h3 > About Hotel </h3> 
                </div>
                <div class="section-border form-14" >
                    <div class="row p-4">
                    {!! $hotel->description !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div id="location" class="row g-4 justified-center">
                    <h3 > Hotel Location </h3> 
                </div>
                <div class="section-border form-14" >
                    <div class="row p-4">
                        <div class="col-md-6" >
                            {!! $hotel->gmap !!}
                        </div>
                        <div class="col-md-6" > 
                            <h6> {{ $hotel->name }} </h5>
                            <p> {{ $hotel->address }}

                            <div class=" my-3" >
                                <a target="_blank" href="https://www.google.com/maps/dir//{{$hotel->address}}" class="btn btn-small btn-secondary" > <i class="fa fa-map-marker"></i> Get Direction </a>
                            </div>
                            <div class=" my-3" >
                                <p class="color-secondary" >
                                    <strong> Call Hotel : <a href="tel:{{ get_theme_setting('mobile') }}" ><i class="fa fa-phone"></i> {{ get_theme_setting('mobile') }} </a> </strong> 
                                </p>
                                <p class="color-secondary">
                                    <strong> Conntent whatsapp : <a href="tel:{{ get_theme_setting('whatsapp') }}" ><i class="fa fa-whatsapp"></i> {{ get_theme_setting('whatsapp') }} </a> </strong>
                                </p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="reviews" class="container-xxl py-5">
            <div class="container">
                    <div id="policies" class="row g-4 justified-center">
                        <h3 > Customer Reviews </h3> 
                    </div>
                    <div class="section-border form-14" >
                        <div class="course-review">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="ratting-preview">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="avrg-rating ul-li">
                                                    <b>Average Rating</b>
                                                    <span class="avrg-rate">5.0</span>
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                    <b>55 Ratings</b>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="avrg-rating ul-li">
                                                    <span>Details</span>
                                                    <div class="rating-overview">
                                                        <span class="start-item">5 Starts</span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count">1.225</span>
                                                    </div>
                                                    <div class="rating-overview">
                                                        <span class="start-item">4 Starts</span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count">0</span>
                                                    </div>
                                                    <div class="rating-overview">
                                                        <span class="start-item">3 Starts</span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count">0</span>
                                                    </div>
                                                    <div class="rating-overview">
                                                        <span class="start-item">2 Starts</span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count">0</span>
                                                    </div>
                                                    <div class="rating-overview">
                                                        <span class="start-item">1 Starts</span>
                                                        <span class="start-bar"></span>
                                                        <span class="start-count">0</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="couse-comment">
                            <div class="blog-comment-area ul-li about-teacher-2">
                                <ul class="comment-list">
                                    <li>
                                        <div class=" comment-avater">
                                            <img src="{{ url('assets/img/user.png')}}" alt="">
                                        </div>

                                        <div class="author-name-rate">
                                            <div class="author-name float-left">
                                                BY: <span>Bapi Patra</span> 
                                            </div>
                                            <div class="comment-ratting float-right ul-li">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="time-comment float-right">55 Days ago</div>
                                        </div>
                                        <div class="author-designation-comment">
                                            <p>Fantastic hotel has come up near Howrah Railway Station. The property is belonged to Sivalika Group. Excellent facilities. Come and experience once
                                                
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" comment-avater">
                                            <img src="{{ url('assets/img/user.png')}}" alt="">
                                        </div>

                                        <div class="author-name-rate">
                                            <div class="author-name float-left">
                                                BY: <span>Brijesh Pandey</span> 
                                            </div>
                                            <div class="comment-ratting float-right ul-li">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="time-comment float-right">30 Days ago</div>
                                        </div>
                                        <div class="author-designation-comment">
                                            <p>
                                                Excellent hotel in Howrah we were regular to Howrah but never seen this type of hotel ever. Clean rooms great location and pleasant stay overall. We will visit again
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class=" comment-avater">
                                            <img src="{{ url('assets/img/user.png')}}" alt="">
                                        </div>

                                        <div class="author-name-rate">
                                            <div class="author-name float-left">
                                                BY: <span>Manoj Gupta</span> 
                                            </div>
                                            <div class="comment-ratting float-right ul-li">
                                                <ul>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                    <li><i class="fa fa-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="time-comment float-right">2 Days ago</div>
                                        </div>
                                        <div class="author-designation-comment">
                                            <p> Very beautiful and well-maintained property, staff behavior is quite decent, nice location, locality is good market place
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <div id="policies" class="row g-4 justified-center">
                    <h3 > {{ $hotel->name }} Policies </h3> 
                </div>
                <div class="section-border form-14" >
                    <div class="row p-4">
                        <div class="col-md-3 py-3"  >
                            <span> Check-in </span>
                            <p> 12:00 PM </p>
                        </div>
                        <div class="col-md-3 py-3"  >
                            <span> Check-out </span>
                            <p> 11:00 AM </p>
                        </div>
                        <div class="col-md-3 py-3"  >
                            <span> Children and Extra Beds </span>
                            <p> Child upto 8 years is Allowed </p>
                        </div>
                        <div class="col-md-3 py-3"  >
                            <span> Local ID </span>
                            <p> Allowed </p>
                        </div>
                        <div class="col-md-3 py-3"  >
                            <span> Couple Friendly </span>
                            <p> Allowed </p>
                        </div>
                        <div class="col-md-3 py-3"  >
                            <span> Foreign Guest </span>
                            <p> Not allowed </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-xxl py-5">
<div class="container">
<div class="row g-5">

<div class="col-lg-8">
<div class="row room-item m-0 mb-4 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="col-md-5 col-lg-12 col-xl-5 p-0" style="min-height: 300px;">
<div class="position-relative h-100">
<img class="position-absolute w-100 h-100" src="img/room-1.jpg" alt="" style="object-fit: cover;">
</div>
</div>
<div class="col-md-7 col-lg-12 col-xl-7 h-100 px-0">
<div class="p-4">
<div class="d-flex align-items-center justify-content-between mb-3">
<small class="bg-primary text-white rounded py-1 px-3">$100/Night</small>
<div class="ps-2">
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
</div>
</div>
<h5 class="mb-3">Junior Suite</h5>
<div class="d-flex mb-3">
<small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
<small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
</div>
<p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
</div>
<div class="d-flex justify-content-between border-top mt-auto p-4">
<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a>
<a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
</div>
</div>
</div>
<div class="row room-item m-0 mb-4 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="col-md-5 col-lg-12 col-xl-5 p-0" style="min-height: 300px;">
<div class="position-relative h-100">
<img class="position-absolute w-100 h-100" src="img/room-2.jpg" alt="" style="object-fit: cover;">
</div>
</div>
<div class="col-md-7 col-lg-12 col-xl-7 h-100 px-0">
<div class="p-4">
<div class="d-flex align-items-center justify-content-between mb-3">
<small class="bg-primary text-white rounded py-1 px-3">$100/Night</small>
<div class="ps-2">
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
</div>
</div>
<h5 class="mb-3">Junior Suite</h5>
<div class="d-flex mb-3">
<small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
<small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
</div>
<p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
</div>
<div class="d-flex justify-content-between border-top mt-auto p-4">
<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a>
<a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
</div>
</div>
</div>
<div class="row room-item m-0 mb-4 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="col-md-5 col-lg-12 col-xl-5 p-0" style="min-height: 300px;">
<div class="position-relative h-100">
<img class="position-absolute w-100 h-100" src="img/room-3.jpg" alt="" style="object-fit: cover;">
</div>
</div>
<div class="col-md-7 col-lg-12 col-xl-7 h-100 px-0">
<div class="p-4">
<div class="d-flex align-items-center justify-content-between mb-3">
<small class="bg-primary text-white rounded py-1 px-3">$100/Night</small>
<div class="ps-2">
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
</div>
</div>
<h5 class="mb-3">Junior Suite</h5>
<div class="d-flex mb-3">
<small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
<small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
</div>
<p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
</div>
<div class="d-flex justify-content-between border-top mt-auto p-4">
<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a>
<a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
</div>
</div>
</div>
<div class="row room-item m-0 mb-4 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="col-md-5 col-lg-12 col-xl-5 p-0" style="min-height: 300px;">
<div class="position-relative h-100">
<img class="position-absolute w-100 h-100" src="img/room-1.jpg" alt="" style="object-fit: cover;">
</div>
</div>
<div class="col-md-7 col-lg-12 col-xl-7 h-100 px-0">
<div class="p-4">
<div class="d-flex align-items-center justify-content-between mb-3">
<small class="bg-primary text-white rounded py-1 px-3">$100/Night</small>
<div class="ps-2">
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
</div>
</div>
<h5 class="mb-3">Junior Suite</h5>
<div class="d-flex mb-3">
<small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
<small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
</div>
<p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
</div>
<div class="d-flex justify-content-between border-top mt-auto p-4">
<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a>
<a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
</div>
</div>
</div>
<div class="row room-item m-0 mb-4 wow fadeInUp" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
<div class="col-md-5 col-lg-12 col-xl-5 p-0" style="min-height: 300px;">
<div class="position-relative h-100">
<img class="position-absolute w-100 h-100" src="img/room-2.jpg" alt="" style="object-fit: cover;">
</div>
</div>
<div class="col-md-7 col-lg-12 col-xl-7 h-100 px-0">
<div class="p-4">
<div class="d-flex align-items-center justify-content-between mb-3">
<small class="bg-primary text-white rounded py-1 px-3">$100/Night</small>
<div class="ps-2">
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
<small class="fa fa-star text-primary"></small>
</div>
</div>
<h5 class="mb-3">Junior Suite</h5>
<div class="d-flex mb-3">
<small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>3 Bed</small>
<small class="border-end me-3 pe-3"><i class="fa fa-bath text-primary me-2"></i>2 Bath</small>
<small><i class="fa fa-wifi text-primary me-2"></i>Wifi</small>
</div>
<p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet.</p>
</div>
<div class="d-flex justify-content-between border-top mt-auto p-4">
<a class="btn btn-sm btn-primary rounded py-2 px-4" href="">View Detail</a>
<a class="btn btn-sm btn-dark rounded py-2 px-4" href="">Book Now</a>
</div>
</div>
</div>
<div class="row wow fadeInUp" data-wow-delay="0.1s" style="visibility: hidden; animation-delay: 0.1s; animation-name: none;">
<div class="col-12">
<nav aria-label="Page navigation">
<ul class="pagination justify-content-center m-0">
<li class="page-item disabled">
<a class="page-link rounded-0" href="#" aria-label="Previous">
<span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
</a>
</li>
<li class="page-item active"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link rounded-0" href="#" aria-label="Next">
<span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
</a>
</li>
</ul>
</nav>
</div>
</div>
</div>


<div class="col-lg-4">

<div class="bg-light mb-5 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="border-bottom text-center text-dark p-3 pt-4 mb-3">
<span class="align-top fs-4 lh-base">$</span>
<span class="align-middle fs-1 lh-sm fw-bold">49.00</span>
<span class="align-bottom fs-6 lh-lg">/ Night</span>
</div>
<div class="row g-3 p-4 pt-2">
<div class="col-12">
<div class="date" id="date3" data-target-input="nearest">
<input type="text" class="form-control datetimepicker-input" placeholder="Check in" data-target="#date3" data-toggle="datetimepicker">
</div>
</div>
<div class="col-12">
<div class="date" id="date4" data-target-input="nearest">
<input type="text" class="form-control datetimepicker-input" placeholder="Check out" data-target="#date4" data-toggle="datetimepicker">
</div>
</div>
<div class="col-12">
<select class="form-select">
<option selected="">Adult</option>
<option value="1">Adult 1</option>
<option value="2">Adult 2</option>
<option value="3">Adult 3</option>
</select>
</div>
<div class="col-12">
<select class="form-select">
<option selected="">Child</option>
<option value="1">Child 1</option>
<option value="2">Child 2</option>
<option value="3">Child 3</option>
</select>
</div>
<div class="col-12">
<select class="form-select">
<option selected="">Night</option>
<option value="1">Night 1</option>
<option value="2">Night 2</option>
<option value="3">Night 3</option>
</select>
</div>
<div class="col-12">
<button class="btn btn-primary py-3 w-100">Book Now</button>
</div>
</div>
</div>


<div class="bg-light p-4 mb-5 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<h4 class="mb-4">Category</h4>
<a class="d-block position-relative mb-3" href="">
<img class="img-fluid" src="img/cat-1.jpg" alt="">
<div class="d-flex position-absolute top-0 start-0 w-100 h-100 p-3" style="background: rgba(0,0,0,.3);">
<h5 class="text-white m-0 mt-auto">luxury Room</h5>
</div>
</a>
<a class="d-block position-relative mb-3" href="">
<img class="img-fluid" src="img/cat-2.jpg" alt="">
<div class="d-flex position-absolute top-0 start-0 w-100 h-100 p-3" style="background: rgba(0,0,0,.3);">
<h5 class="text-white m-0 mt-auto">Couple Room</h5>
</div>
</a>
<a class="d-block position-relative" href="">
<img class="img-fluid" src="img/cat-3.jpg" alt="">
<div class="d-flex position-absolute top-0 start-0 w-100 h-100 p-3" style="background: rgba(0,0,0,.3);">
<h5 class="text-white m-0 mt-auto">Single Room</h5>
</div>
</a>
</div>


<div class="border p-1 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
<div class="border p-4">
<h4 class="mb-4">Help &amp; Support</h4>
<p>Lorem sed erat elitr magna magna labore duo elitr ipsum duo. Et sed duo rebum lorem sed stet sed</p>
<div class="bg-primary text-center p-3">
<h4 class="text-white m-0">+012 345 67890</h4>
</div>
</div>
</div>

</div>

</div>
</div>
</div>
        
        
        <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
            <div class="row justify-content-center">
                <div class="col-lg-10 border rounded p-1">
                    <div class="border rounded text-center p-1">
                        <div class="bg-white rounded text-center p-5">
                            <h4 class="mb-4">Subscribe Our <span class="text-primary text-uppercase">Newsletter</span></h4>
                            <div class="position-relative mx-auto" style="max-width: 400px;">
                                <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                                <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('script')

<!-- ============================================================== -->
<!-- CHARTS -->
@endsection