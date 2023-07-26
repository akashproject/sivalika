@extends('layouts.main')
    @section('content')
    <style>
        .outer { margin:0 auto; max-width:800px;}
        #big .item {margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
        #thumbs .item { background: #C9C9C9; height:70px; line-height:70px; padding: 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; cursor: pointer; }
        #thumbs .item h1 { font-size: 18px; }
        #thumbs .current .item { background:#FF5722; }
        .owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
        .owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
        #big.owl-theme { position: relative; }
        #big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#333; width: 22px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
        #big.owl-theme .owl-prev { left: 10px; }
        #big.owl-theme .owl-next { right: 10px; }
        #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { }
    </style>
    
        
    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Room Booking</h6>
                <h1 class="mb-5"><span class="text-primary text-uppercase">{{ $hotel->name }}</span></h1>
            </div>
            <div class="row g-5">
                @if($hotel->gallery)
                <div class="col-lg-6">
                    <div class="outer">
                        <div id="big" class="owl-carousel owl-theme">
                            @foreach(json_decode($hotel->gallery) as $thumb)
                            <div class="item">
                                <img class="img-fluid rounded w-100 wow zoomIn" src="{{ getSizedImage('',$thumb); }}">
                            </div>
                            @endforeach
                        </div>
                       
                        <div id="thumbs" class="owl-carousel owl-theme">             
                            @foreach(json_decode($hotel->gallery) as $thumb)               
                            <div class="item">
                                <img class="img-fluid rounded w-100 wow zoomIn" src="{{ getSizedImage('',$thumb); }}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-6">
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <form>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkin" placeholder="Check In" data-target="#date3" data-toggle="datetimepicker" />
                                        <label for="checkin">Check In</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date4" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" id="checkout" placeholder="Check Out" data-target="#date4" data-toggle="datetimepicker" />
                                        <label for="checkout">Check Out</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="select1">
                                            <option value="1">Adult 1</option>
                                            <option value="2">Adult 2</option>
                                            <option value="3">Adult 3</option>
                                        </select>
                                        <label for="select1">Select Adult</label>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="select2">
                                            <option value="1">Child 1</option>
                                            <option value="2">Child 2</option>
                                            <option value="3">Child 3</option>
                                        </select>
                                        <label for="select2">Select Child</label>
                                        </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <select class="form-select" id="select3">
                                            <option value="1">Room 1</option>
                                            <option value="2">Room 2</option>
                                            <option value="3">Room 3</option>
                                        </select>
                                        <label for="select3">Select A Room</label>
                                        </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Special Request" id="message" style="height: 100px"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justified-center">
                <h3 >Select Rooms </h3> 
            </div>
            <div class="row g-4 justified-center">
                @foreach($rooms as $kKey => $room)

                <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="room-item shadow rounded overflow-hidden">
                        <div class="position-relative">
                            <img class="img-fluid" src="{{ getSizedImage('',$room->featured_image) }}" alt="">
                            <small class="position-absolute start-0 top-100 translate-middle-y bg-primary text-white rounded py-1 px-3 ms-4">₹{{$room->cost}}/Night</small>
                        </div>
                        <div class="p-4 mt-2">
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
                                <small class="border-end me-3 pe-3"><i class="fa fa-home text-primary me-2"></i>{{$room->size}}</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room->person}} Bed</small>
                                <small class="border-end me-3 pe-3"><i class="fa fa-bed text-primary me-2"></i>{{$room->room_count}} Left</small>
                            </div>
                            <div class="d-flex mb-3 row">
                                <div class="col-md-5" >
                                    <span> Room 1 </span>
                                </div>
                                <div class="col-md-5" >
                                <span class="remove-guest px-2" > <i class="fa fa-minus-circle text-primary me-2"></i> </span> <span> 1 Guest </span> <span class="add-guest px-2" > <i class="fa fa-plus-circle text-primary me-2"></i> </span>
                                </div>
                                <div class="col-md-2" >
                                    <span class="" > <i class="fa fa-trash text-primary me-2"></i> </span>
                                </div>
                            </div>
                            <div class="d-flex mb-3 row">
                                <a href="javascrit:void(0)" class="addMoreRoom"> <i class="fa fa-plus text-primary me-2"></i> Add room </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justified-center">
                <h3 > Hotel Amenities </h3> 
            </div>
            <div class="section-border form-14" >
                <div class="row p-4">
                    @foreach(json_decode($hotel->amenities) as $key => $value)
                    <div class="col-md-2 py-3"  >
                        <i class="fa fa-check" aria-hidden="true"></i> {{ $value }}
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justified-center">
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
            <div class="row g-4 justified-center">
                <h3 > Hotel Location </h3> 
            </div>
            <div class="section-border form-14" >
                
            </div>
        </div>
    </div>

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4 justified-center">
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