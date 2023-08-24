@extends('layouts.main')
    @section('content')
    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row">
                <h6 class="text-uppercase"><a href="{{ url('/') }}" > <i class="fa fa-arrow-left" ></i> Back to Hotel</a> </h6>
            </div>
            <div class="row g-5">
                <div class="col-lg-7 py-3">
                    <div class="personal_info_content wow fadeInUp" data-wow-delay="0.2s">
                        <div class="personal_info_title mb-2" >
                            <h5> Enter your booking details</h5>
                        </div>
                        <div class="personal_form_data" >
                            <form id="customer_ragistration_form" method="post" action="{{ url('confirm-booking')}}" >
                                @csrf
                                <div class="registration_process step-1 active " >
                                    <div class="row g-3">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="firstname" id="formFieldFirstName" placeholder="Your Name" value="{{(Auth::check())?Auth::user()->name:''}}" required>
                                                <label for="name">First Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" name="lastname" id="formFieldLastName" placeholder="Your Name" value="{{(Auth::check())?Auth::user()->name:''}}" required>
                                                <label for="name">Last Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" name="email" id="formFieldEmail" placeholder="Your Email" value="{{(Auth::check())?Auth::user()->email:''}}" required>
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating">
                                                @if(Auth::check())
                                                <div class="form-control">
                                                    {{Auth::user()->mobile}}
                                                    <label for="mobile" style="opacity: .65;transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);display: inline-flex;position: absolute;top: 13px;left: 0;">Your Mobile</label>
                                                    <input type="hidden" name="mobile" id="formFieldMobile" placeholder="Your Mobile" value="{{Auth::user()->mobile}}">
                                                </div>
                                                @else
                                                <input type="number" class="form-control" name="mobile" id="formFieldMobile" placeholder="Your Mobile" value="" required>
                                                <label for="mobile">Your Mobile</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-secondary w-100 py-3 submit_customer_ragistration_form" data-value="pay_later" type="submit">Pay @ Hotel</button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-primary w-100 py-3 submit_customer_ragistration_form" data-value="book_now" type="submit">Book Now</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="registration_process step-2 text-center" >
                                    <div class="otp-content">
                                        <h4 class="otp-heading"> OTP Verification </h4>                                   
                                        <p class="message"> <span class="message"> Enter the OTP you recive at </span> +91 XXXXXX<span class="lastDigit">0000</span> <span class="changeGivenNumber"> (Change) </span> </p>
                                        <p class="response_status" style="color: #000;"></p>
                                    </div>
                                    
                                    <div class="row justified-center">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating">
                                                <input type="text" class="form-control verify_otp" name="verify_otp" id="" placeholder="Enter one time password">
                                                <label for="email">Enter OTP</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="otp-content">
                                        <p class="message"> Did not recive OTP?
                                            <span class="countdown_label"> Resend in <span class="countdown">-1:59</span> Sec </span>
                                            <a class="resendOtp display-none" href="javascript:void(0)"> Resend OTP </a>
                                        </p>
                                    </div>
                                    <div class="row justified-center " >
                                        <div class="col-md-6">
                                            <button class="btn btn-secondary w-100 py-3 submit_customer_ragistration_form" type="submit">
                                                Confirm Booking
                                            </button>
                                            <div >
                                                 <img src="https://www.icacourse.in/wp-content/themes/scriptcrown/images/loader.gif" style="width: 42px; display:none;" class="checkout_loader">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="formFieldOtpResponse" value="">
                                <input type="radio" name="payTime" id="pay_later" value="pay_later" style="visibility: hidden;">
                                <input type="radio" name="payTime" id="book_now" value="book_now" style="visibility: hidden;">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 py-3">
                    <div class="checkout_review mb-5">
                        <div class="payment_title" > 
                            <div class="row" >
                                <div class="col-6">
                                    <h5> Payable Amount : <span> Including GST </span></h5>
                                </div>
                                <div class="col-6 text-right">
                                    <h5 class="paying_amount" style="font-size: 36px; margin-bottom: 0;color: #160e42;"><strong>₹{{$checkinRooms['amount']}} </strong></h5>
                                </div>
                            </div>
                        </div>
                        <div class="review_content" >
                            <h4> {{$hotel->name}} </h4>
                            <p class="address_review" >{{$hotel->address}}</p>

                            <div class="review_room" > 
                                @php $i = 1; $guests = '0'; @endphp
                                @foreach($checkinRooms['rooms'] as $key => $value)
                                    @if(!empty($value))
                                        <strong> {{count($value)}}x {{get_room_by_id($key)->name}} </strong> <br>
                                    @endif
                                   
                                @endforeach
                               
                                <h5> Total Guest : {{$checkinRooms['total_guest']}}
                            </div>
                        </div>
                        <div class="review_checkin text-center" >
                            <div class="row " >
                                <div class="col-4">
                                    <span> Checkin </span>
                                    <h5> {{ date('d M',strtotime($checkinRooms['t-start'])) }} </h5>
                                </div>
                                <div class="col-4">
                                    <span> Checkout </span>
                                    <h5><strong> {{ date('d M',strtotime($checkinRooms['t-end'])) }} </strong></h5>
                                </div>
                                <div class="col-4">
                                    <span> Guest </span>
                                    <h5><strong> {{$checkinRooms['total_guest']}} Person </strong></h5>
                                </div>
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