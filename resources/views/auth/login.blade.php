<!-- resources/views/auth/login.blade.php -->
@extends('layouts.main')
    @section('content')
     <!-- Booking Start -->
     <div class="container-xxl py-3">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title text-center text-primary text-uppercase">Login</h6>
                <h1 class="mb-5"><span class="text-primary text-uppercase">Login Yourself</span></h1>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="tel" name="mobile" placeholder="Mobile Number">
                <input type="text" name="otp" placeholder="OTP">
                <button type="submit">Login</button>
            </form>
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