<div class="container-xxl bg-white p-0">
	<!-- Spinner Start -->
	<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
		<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<!-- Spinner End -->
	<!-- Header Start -->
	<div class="container-fluid bg-dark px-0 desktop-menu">
		<div class="row gx-0">
			<div class="col-lg-2 bg-dark d-none d-lg-block">
				<a href="{{ url('/')}}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-contgent-center">
					<img src="{{ url('assets/img/logo.png')}}" style="width: 42%;">
				</a>
			</div>
			<div class="col-lg-10">
				<div class="row gx-0 bg-white d-none d-lg-flex">
					<div class="col-lg-7 px-5 text-start">
						<div class="h-100 d-inline-flex align-items-center py-2 me-4">
							<i class="fa fa-envelope text-primary me-2"></i>
							<p class="mb-0">{{ get_theme_setting('email') }}</p>
						</div>
						<div class="h-100 d-inline-flex align-items-center py-2">
							<i class="fa fa-phone-alt text-primary me-2"></i>
							<p class="mb-0">{{ get_theme_setting('mobile') }}</p>
						</div>
					</div>
					<div class="col-lg-5 px-5 text-end">
						<div class="d-inline-flex align-items-center py-2">
							<a class="me-3" href=""><i class="fab fa-facebook-f"></i></a>
							<a class="me-3" href=""><i class="fab fa-twitter"></i></a>
							<a class="me-3" href=""><i class="fab fa-linkedin-in"></i></a>
							<a class="me-3" href=""><i class="fab fa-instagram"></i></a>
							<a class="" href=""><i class="fab fa-youtube"></i></a>
						</div>
					</div>
				</div>
				<nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
					<a href="{{ url('/')}}" class="navbar-brand d-block d-lg-none">
						<h1 class="m-0 text-primary text-uppercase">Hotelier</h1>
					</a>
					<button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
						<div class="navbar-nav mr-auto py-0">
										
						</div>
						@if(Auth::check())
						<div class="nav navbar-nav navbar-right">
							<div class="nav-item dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">My Account</a>
								<div class="dropdown-menu rounded-0 m-0">
									<a href="{{ url('bookings') }}" class="dropdown-item">Booking</a>
									<a href="{{ url('profile') }}" class="dropdown-item">Profile</a>
									<a href="{{ url('logout') }}" class="dropdown-item">Logout</a>
								</div>
							</div>	
						</div>
						@else
						<div class="nav navbar-nav navbar-right">
							<a href="#login-form-popup" class="open-popup-link nav-item nav-link">Login / Sign up</a>
						</div>
						@endif
					</div>
				</nav>
			</div>
		</div>
	</div>
	<div class="top-mobile-menu bg-dark">
		<div class="logo-wrapper" >
			<a href="{{ url('/')}}" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
				<img src="{{ url('assets/img/logo.png')}}" style="width: 28%;">
			</a>
		</div>
		@if(Auth::check())
		<div class="login-wrapper" >
			<a href="{{ url('/profile')}}" class=" header_login_btn" > Profile </a>
		</div>
		@else
		<div class="login-wrapper" >
			<a href="#login-form-popup" class="open-popup-link header_login_btn" > Login/Signup </a>
		</div>
		@endif
	</div>
	<!-- Header End -->
