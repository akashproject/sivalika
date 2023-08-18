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
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <form id="contactForm" novalidate="novalidate" method="post" action="{{ url('update-profile')}}" >
                        @csrf
                        <div class="row gx-3">
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Name" required="required" data-validation-required-message="Please enter your name" value="{{current(explode(' ',$user->name))}}" >
                                    <label for="name">First Name</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    @php
                                        $elem = explode(' ',$user->name);
                                        $lastname = $elem[count($elem) - 1]
                                    @endphp
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Name" required="required" data-validation-required-message="Please enter your name" value='{{ $lastname }}' >
                                    <label for="name">Last Name</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="required" data-validation-required-message="Please enter your email" value="{{$user->email}}">
                                    <label for="email">Your Email</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" required="required" data-validation-required-message="Please enter your email" value="{{$user->mobile}}" readonly>
                                    <label for="email">Your Mobile</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="dob" name="dob" placeholder="Enter Date of birth" required="required" data-validation-required-message="Please enter your email" value="{{$user->dob}}" >
                                    <label for="email">Your Date of birth</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <select class="form-select" id="gender" name="gender">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="undisclosed">Undisclosed</option>
                                    </select>
                                    <label for="select2">Select Gender</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-md-6 control-group">
                                <div class="form-floating">
                                    <select class="form-select" id="marital_status" name="marital_status">
                                        <option value="married">Married</option>
                                        <option value="unmarried">Unmarried</option>
                                        <option value="undisclosed">Undisclosed</option>
                                    </select>
                                    <label for="select2">Select Gender</label>
                                </div>
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="col-12 mt-2">
                                <button class="btn btn-primary w-100 py-3" type="submit" id="sendMessageButton">
                                    <span>Update Profile</span>
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