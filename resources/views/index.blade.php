@extends('layouts.main')
    @section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="assets/img/carousel-1.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">Discover Luxurious De Sivalika Belur</h1>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="assets/img/carousel-1.png" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 700px;">
                            <h6 class="section-title text-white text-uppercase mb-3 animated slideInDown">Luxury Living</h6>
                            <h1 class="display-3 text-white mb-4 animated slideInDown">Discover Luxurious Sivalika Inn Howrah</h1>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <div class="container-fluid booking pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <!-- Booking Start -->
            @include('common.booking-form')
            <!-- Booking End -->
        </div>
    </div>

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary text-uppercase">Sivalika Hotels</span></h1>
                    <p class="mb-4">Sivalika Hotels a subsidiary company by Sivalika Group started its journey in 2017 as an affordable luxury hotel brand in Howrah. Our motto is to provide luxury service in an affordable price to the visitors of Belurmath, Dakhineswar and Howrah.</p>
                    <div class="row g-3 pb-4">
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                    <h3 class="mb-1">300K +</h3>
                                    <p class="mb-0">Guests</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-hotel fa-2x text-primary mb-2"></i>
                                    <h3 class="mb-1">360K +</h3>
                                    <p class="mb-0">Room Nights</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="border rounded p-1">
                                <div class="border rounded text-center p-4">
                                    <i class="fa fa-users-cog fa-2x text-primary mb-2"></i>
                                    <h3 class="mb-1">50+</h3>
                                    <p class="mb-0">Staffs</p>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="assets/img/about-1.jpg" style="margin-top: 25%;">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="assets/img/about-2.jpg">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="assets/img/about-3.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="assets/img/about-4.jpg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Video Start -->
    <div class="container-xxl px-0 wow zoomIn" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5">
                    <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Living</h6>
                    <h1 class="text-white mb-4">Check IN Luxurious De Sivalika Belur</h1>
                    <p class="text-white mb-4">De Sivalika Boutique Hotel, established in 2017 by Sivalika Group is a masterpiece small luxury hotel in Belurmath, Howrah. The hotel is situated a stone away from Belurmath, 5km away from Dakhineswar Temple, 6km away from Howrah Railway station and just 12km away from Kolkata international airport. Our motto is to provide luxury service in an affordable price to the visitors of Belurmath, Dakhineswar and surrounding area. We have 28 spacious rooms with a world class kitchen which serves Chinese, Indian, Tandoor and Continental cuisines to all our guests. We also provide Take away and home delivery service.</p>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ url('hotel/sivalika-inn-belur') }}">Our Rooms</a>
                        <a class="btn btn-sm btn-dark rounded py-2 px-4 white-outline" href="{{ url('hotel/sivalika-inn-belur') }}">Book Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="video" style="background: linear-gradient(rgba(15, 23, 43, .1), rgba(15, 23, 43, .1)), url(assets/img/sivalika-belur.webp);">
                </div>
            </div>
        </div>
    </div>
    <!-- Video Start -->

        <!-- Video Start -->
    <div class="container-xxl px-0 wow zoomIn" data-wow-delay="0.1s">
        <div class="row g-0">
            <div class="col-md-6">
                <div class="video" style="background: linear-gradient(rgba(15, 23, 43, .1), rgba(15, 23, 43, .1)), url(assets/img/sivalika-inn-howrah.webp);">
                </div>
            </div>
            <div class="col-md-6 bg-dark d-flex align-items-center">
                <div class="p-5">
                    <h6 class="section-title text-start text-white text-uppercase mb-3">Luxury Living</h6>
                    <h1 class="text-white mb-4">Check IN Luxurious De Sivalika INN - Howrah</h1>
                    <p class="text-white mb-4">Sivalika Inn a small premium hotel established in 2023 by Sivalika Hotels which situated very near to Howrah Railway Station- one of leading & busiest railway station in India. The hotel received a 5 * ratings in Google among its visiting guests. We welcome every guest to come and experience our service in affordable price.</p>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-sm btn-primary rounded py-2 px-4" href="{{ url('hotel/sivalika-inn-howrah') }}">Our Rooms</a>
                        <a class="btn btn-sm btn-dark rounded py-2 px-4 white-outline" href="{{ url('hotel/sivalika-inn-howrah') }}">Book Now</a>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-6">
                            <a href="{{ url('hotel/sivalika-inn-howrah') }}" class="btn btn-primary py-md-3 px-md-5 me-3">Our Rooms</a>
                        </div>
                        <div class="col-md-6">
                            <a href="" class="btn btn-light py-md-3 px-md-5">Book A Room</a>
                        </div>
                    <div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Video Start -->

    <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- 16:9 aspect ratio -->
                    <div class="ratio ratio-16x9">
                        <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Video Start -->
    
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title text-center text-primary text-uppercase">Our Services</h6>
                <h1 class="mb-5">Explore Our <span class="text-primary text-uppercase">Services</span></h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-hotel fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Premium Rooms</h5>
                        <p class="text-body mb-0">We have spacious rooms with a world class kitchen which serves Chinese, Indian, Tandoor and Continental cuisines to all our guests.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-plane fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Travel Desk</h5>
                        <p class="text-body mb-0">We have dedicated travel desk service facility to all our guests who need assistance with related to their travelling needs.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-car fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Car Renta</h5>
                        <p class="text-body mb-0">We provide rental car facility to all of our guests with respect to inter-city & intra-city travel needs.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-utensils fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">Delicious Foods</h5>
                        <p class="text-body mb-0">We have dedicated kitchen which serves Chinese, Indian, Tandoor and Continental cuisines to all our guests.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-shield fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">24x7 Security</h5>
                        <p class="text-body mb-0">We Provide 24x7 Security </p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="fa fa-dumbbell fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3">GYM & Yoga</h5>
                        <p class="text-body mb-0">Erat ipsum justo amet duo et elitr dolor, est duo duo eos lorem sed diam stet diam sed stet lorem.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Testimonial Start -->
    <div class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s">
        <div class="container">
            <div class="owl-carousel testimonial-carousel py-5">
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>Fantastic hotel has come up near Howrah Railway Station. The property is belonged to Sivalika Group. Excellent facilities. Come and experience once</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('assets/img/user.png')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Bapi Patra</h6>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>Excellent hotel in Howrah we were regular to Howrah but never seen this type of hotel ever. Clean rooms great location and pleasant stay overall. We will visit again </p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('assets/img/user.png')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Brijesh Pandey</h6>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p>Very beautiful and well-maintained property, staff behavior is quite decent, nice location, locality is good market place.</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="{{ url('assets/img/user.png')}}" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1">Manoj Gupta</h6>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Newsletter Start -->
    <div class="container newsletter mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="row justify-content-center">
            <div class="col-lg-10 border rounded p-1">
                <div class="border rounded text-center p-1">
                    <div class="bg-white rounded text-center p-5">
                        <h4 class="mb-4">Get Your <span class="text-primary text-uppercase">Best Offer</span></h4>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your Mobile number ">
                            <button type="button" class="btn btn-primary py-2 px-3 position-absolute top-0 end-0 mt-2 me-2">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Start -->
	
    @endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection