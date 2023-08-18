 <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container pb-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-4">
                    <div class="bg-primary rounded p-4">
                        <div class="text-center">
                            <a href="{{ url('/') }}">
                                <img src="{{ url('assets/img/logo.png')}}" style="width: 28%;">
                            </a>
                        </div>
                        <p class="color-secondary mb-0">
                            <strong> Sivalika Hotels a subsidiary company by Sivalika Group started its journey in 2017 as an affordable luxury hotel brand in Howrah. Our motto is to provide luxury service in an affordable price to the visitors.</strong> 
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ get_theme_setting('address') }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ get_theme_setting('mobile') }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ get_theme_setting('email') }}</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12">
                    <div class="row gy-5 g-4">
                        <div class="col-md-6">
                            <h6 class="section-title text-start text-primary text-uppercase mb-4">Company</h6>
                            <a class="btn btn-link" href="">About Us</a>
                            <a class="btn btn-link" href="">Contact Us</a>
                            <a class="btn btn-link" href="">Privacy Policy</a>
                            <a class="btn btn-link" href="">Terms & Condition</a>
                            <a class="btn btn-link" href="">Support</a>
                        </div>
                        <div class="col-md-6">
                            <h6 class="section-title text-start text-primary text-uppercase mb-4">Services</h6>
                            <a class="btn btn-link" href="">Premium Rooms</a>
                            <a class="btn btn-link" href="">Travel Desk</a>
                            <a class="btn btn-link" href="">Car Rental</a>
                            <a class="btn btn-link" href="">Delicious Foods</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Sivalika</a>, All Right Reserved. 
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <div id="login-form-popup" class="white-popup mfp-hide">
        <div class="personal_info_content wow fadeInUp" data-wow-delay="0.2s">
            <div class="personal_info_title mb-2" >
                <h5> Login Yourself</h5>
            </div>
            <div class="personal_form_data" >
                <form id="customer_login_form" method="post" action="{{ url('login')}}" >
                    @csrf
                    <div class="registration_process step-1 active " >
                        <div class="row g-3">
                            <div class="form-floating">
                                <input type="number" class="form-control" name="mobile" id="formFieldMobile" placeholder="Your Mobile" value="" required>
                                <label for="mobile">Your Mobile</label>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-secondary w-100 py-3 submit_customer_ragistration_form" type="submit">Login</button>
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
                                    Login
                                </button>
                                <div >
                                    <img src="https://www.icacourse.in/wp-content/themes/scriptcrown/images/loader.gif" style="width: 42px; display:none;" class="checkout_loader">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="formFieldOtpResponse" value="">
                </form>
            </div>
        </div>
    </div>
</div>