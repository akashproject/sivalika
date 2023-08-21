@extends('layouts.main')
    @section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="bg-light p-4 mb-5 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                        <h4 class="section-title text-start mb-4">My Profile</h4>
                        <div class="category-list d-flex flex-column">
                        <a class="text-body d-flex mb-3" href="{{url('profile')}}">Profile</a>
                            <a class="text-body d-flex mb-3" href="{{url('bookings')}}">Bookings</a>
                            <a class="text-body d-flex mb-3" href="{{url('logout')}}">Logout</a>
                            <a class="text-body d-flex mb-3" href="#">Privacy &amp; Policies</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="booking-report py-2">
                        <div class="text-center mb-2">
                            <h6 class="section-title text-center text-primary text-uppercase">Booking Details</h6>
                        </div>
                        @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                        @endif
                        @foreach($bookings as $booking)

                        <div class="hotel-content mb-5" style="width:100%">
                            <div class="width-100 hotel-thumb">
                                <div class="hotel-image mb-3">
                                    
                                    <img class="width-100" src="{{ getSizedImage('',get_hotel_by_id($booking->hotel_id)->featured_image); }}">
                                </div>
                                <div class="hotel-details">
                                    <h6> {{get_hotel_by_id($booking->hotel_id)->name}} </h6>
                                    <p> {{get_hotel_by_id($booking->hotel_id)->address}} </p>
                                        
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
                                    @switch($booking->status)
                                        @case("cancel")
                                            <a href="javascript:void(0)" class="p-2 px-5 mr-3 cancel-booking-btn " style="background: #ccc !important;color: #000;"> Cancelled </a>
                                            <a href="{{ url('hotel/'.get_hotel_by_id($booking->hotel_id)->slug) }}" class="btn-secondary text-white p-2 px-5 pay-now-btn"> Book Again </a>
                                        @break
                                        @case("comfirm")
                                            <a href="{{ url('cancel-booking/'.$booking->id) }}" class=" btn-primary text-white p-2 px-5 mr-3 cancel-booking-btn "  onclick="return confirm('Are you sure to cancel the booking?')"; > Cancel Booking </a>
                                        @break
                                        @case("arrvied")
                                            <a href="javascript:void(0)" class=" btn-secondary text-white p-2 px-5 mr-3 cancel-booking-btn " > Active </a>
                                        @break
                                        @case("completed")
                                            <a href="javascript:void(0)" class=" btn-primary text-white p-2 px-5 mr-3 cancel-booking-btn" > Completed </a>
                                        @break
                                    @endswitch

                                    @if($booking->payment == "pending" && $booking->status != "cancel")
                                        <a href="javascript:void()" class="btn-secondary text-white p-2 px-5 pay-now-btn"> Pay Now </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @endforeach
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

    <div id="cancel-booking-popup" class="white-popup mfp-hide">
        <div class="personal_info_content wow fadeInUp" data-wow-delay="0.2s">
            <div class="personal_info_title mb-2" >
                <h5> Login Yourself</h5>
            </div>
            <div class="personal_form_data" >
                <form id="cancel-booking- method="post" action="{{ url('cancel-booking')}}" >
                    @csrf
                    
                </form>
            </div>
        </div>
    </div>
    @endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection