@extends('layouts.main')
    @section('content')
    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="thank-you-container" >
                <div class="row justify-content-center">
                    <div class="col-lg-10 border rounded p-1">
                        <div class="border rounded text-center p-1">
                            <div class="bg-white rounded text-center p-5 px-5">
                                <div class="booking_success">
                                    <h1 class="booking-success-heading"> <i class="fa fa-check-circle ml-2"></i> </h1>
                                    @if (Auth::check())
                                     Hi {{ Auth::user()->name }},
                                    @endif
                                    <h4 class="booking-success-subheading">Booking Successfully Confirmed</h4>
                                    <p> Booking Detaiils has been sent to your email address </p>
                                    <h4 class="booking-success-subheading">BOOKING ID <strong><u> {{$booking->booking_id}}</u> </strong> </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="booking-report py-2">
                <div class="text-center mb-2">
                    <h6 class="section-title text-center text-primary text-uppercase">Booking Details</h6>
                </div>
                <div class="hotel-content">
                    <div class="width-100 hotel-thumb">
                        <div class="hotel-image mb-3">
                            <img class="width-100" src="{{ getSizedImage('',$hotel->featured_image); }}">
                        </div>
                        <div class="hotel-details">
                            <h6> {{$hotel->name}} </h6>
                            <p> {{$hotel->address}} </p>
                            <div class="review_room">   
                                @foreach($reserve_rooms as $room)                       	
                                <strong> {{$room->total_room_book}}x {{get_room_by_id($room->room_id)->name}} </strong><br>
                                @endforeach
                            </div>  
                            <div class="review_room">   
                                <h5>Total Guest : {{ $booking->total_guest }}</h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="width-100 text-center">
                        <div class="row ">
                            <div class="col-4">
                                <span> Checkin </span>
                                <h5> {{date("d M",strtotime($booking->checkin))}} </h5>
                            </div>
                            <div class="col-4">
                                <span> Checkout </span>
                                <h5><strong> {{date("d M",strtotime($booking->checkout))}} </strong></h5>
                            </div>
                            <div class="col-4">
                                <span> Guest </span>
                                <h5><strong> {{$booking->total_guest}} Person </strong></h5>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="width-100">
                        <div class="row ">
                            <div class="col-md-9">
                                <h5> Booking Amount </h5>
                            </div>
                            <div class="col-md-3 text-right">
                                <h4><strong> ₹{{$booking->amount}} </strong></h4> </br>
                            </div>
                        </div>
                        <div class="text-right">
                        @if($booking->payment == "pending")
                        <a href="javascript:void()" class="btn-secondary text-white p-2 px-5"> Pay Now </a>
                        @endif
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