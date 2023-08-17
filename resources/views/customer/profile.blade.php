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
                            <a class="text-body d-flex mb-3" href="#">Privacy &amp; Policies</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form id="contactForm" novalidate="novalidate">
                        <div class="row gx-3">
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" placeholder="Your Name" required="required" data-validation-required-message="Please enter your name">
                                    <label for="name">Your Name</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email" required="required" data-validation-required-message="Please enter your email">
                                    <label for="email">Your Email</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-12 control-group">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" placeholder="Subject" required="required" data-validation-required-message="Please enter a subject">
                                    <label for="subject">Subject</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-12 control-group">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" required="required" data-validation-required-message="Please enter your message" style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit" id="sendMessageButton">
                                    <span>Send Message</span>
                                    <div class="d-none spinner-border spinner-border-sm text-light ms-3" role="status"></div>
                                </button>
                            </div>
                        </div>
                    </form>
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