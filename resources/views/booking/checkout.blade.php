@extends('layouts.main')
    @section('content')
    <!-- Booking Start -->
    <div class="container-xxl py-3">
        <div class="container">
            <div class="row">
                <h6 class="text-uppercase"><a href="{{ url('/') }}" > <i class="fa fa-arrow-left" ></i> Back to Hotel</a> </h6>
            </div>
            <div class="row g-5">
                <div class="col-lg-7 py-3">
                    <div class="personal_info_content wow fadeInUp" data-wow-delay="0.2s">
                        <div class="personal_info_title mb-5" >
                            <h5> Enter your booking details</h5>
                        </div>
                        <div class="personal_form_data" >
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
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="mobile" placeholder="Your Mobile">
                                            <label for="mobile">Your Mobile</label>
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
                <div class="col-lg-5 py-3">
                    <div class="checkout_review mb-5">
                        <div class="payment_title" > 
                            <h4> Payable Amount : 2000/- <span> Including GST </span></h4>
                        </div>
                        <h4> De Sivalika - Belur </h4>
                        <p>317, Grand Trunk Rd, Belur Math, Howrah, Kolkata, India, 711202 </p>

                        <div class="" > 
                            <p> 1x Deluxe Room for 2 Guest </p>
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