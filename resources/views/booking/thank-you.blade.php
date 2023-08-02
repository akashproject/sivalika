@extends('layouts.main')
    @section('content')
    <!-- Booking Start -->
    <div class="container-xxl py-3">
        <div class="container">
            <div class="thank-you-container" >
                <div class="row justify-content-center">
                    <div class="col-lg-10 border rounded p-1">
                        <div class="border rounded text-center p-1">
                            <div class="bg-white rounded text-center p-5">
                                <div class="booking_success">
                                    <h1 class="booking-success-heading"> <i class="fa fa-check-circle ml-2"></i> </h1>
                                    <h4 class="booking-success-subheading">Booking Successfully Confirmed</h4>
                                    <p> Booking Detaiils has been sent to your email address </p>
                                    <h4 class="booking-success-subheading">BOOKING ID <strong> 54788788 </strong> </h4>
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
                    <div class="width-100" style="display: flex;">
                        <div class="hotel-image">
                            <img class="width-100" src="{{ url('public/upload/2023-07-13/10.jpg') }}">
                        </div>
                        <div class="hotel-details">
                            <h6> Sivalika Inn - Howrah </h6>
                            <p> 2, Watkins Ln, Babudanga, Pilkhana, Mali Panchghara, Howrah, West Bengal 711101 </p>
                            <div class="review_room">                          	
                                <strong> 1x Deluxe Room for 2 Guest </strong>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="width-100 text-center">
                        <div class="row ">
                            <div class="col-4">
                                <span> Checkin </span>
                                <h5> 11 July </h5>
                            </div>
                            <div class="col-4">
                                <span> Checkout </span>
                                <h5><strong> 12 July </strong></h5>
                            </div>
                            <div class="col-4">
                                <span> Guest </span>
                                <h5><strong> 5 Person </strong></h5>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="width-100">
                        <div class="row ">
                            <div class="col-10">
                                <h5> Booking Amount </h5>
                            </div>
                            <div class="col-2">
                                <h5><strong> ₹3000 </strong></h5>
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