@extends('layouts.main')
    @section('content')
    <div class="container-xxl py-5" >
        <div class="container">
            <div class="row g-5">
                <div class="booking-report py-2">
                    <div class="text-center mb-2">
                        <h1 class="section-title text-center text-secondary text-uppercase">Payment Failed</h1>
                    </div>
                </div>            
            </div>
            <div class="row g-5">
                <div class="text-center mb-2">
                <a href="https://hotels.sivalikagroup.com" class="btn-secondary text-white p-2 px-5 pay-now-btn"> Book Again </a>
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