@extends('layouts.admin')
@section('content')
	<div class="container-fluid">
		<!-- ============================================================== -->
		<!-- Sales Cards  -->
		<!-- ============================================================== -->
		<div class="row">
			<!-- Column -->
			<div class="col-md-6 col-lg-2 col-xlg-3">
				<div class="card card-hover">
					<a class="box bg-cyan text-center" href="{{ url('bookings') }}?checkin={{ date('Y-m-d') }}">
						<h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
						<h6 class="text-white">Bookings ({{ $booking }})</h6>
					</a>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-6 col-lg-2 col-xlg-3">
				<div class="card card-hover">
					<a class="box bg-success text-center" href="{{ url('customers') }}">
						<h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
						<h6 class="text-white">Customers</h6>
					</a>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-4 col-lg-2 col-xlg-3">
				<div class="card card-hover">
					<a class="box bg-warning text-center" href="{{ url('bookings') }}?checkin={{ date('Y-m-d') }}">
						<h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
						<h6 class="text-white">Guests </h6>
					</a>
				</div>
			</div>
			<!-- Column -->
			<div class="col-md-4 col-lg-2 col-xlg-3">
				<div class="card card-hover">
					<a class="box bg-danger text-center" href="{{ url('hotel-rooms') }}?checkin={{ date('Y-m-d') }}">
						<h1 class="font-light text-white"><i class="mdi mdi-hotel"></i></h1>
						<h6 class="text-white">Rooms</h6>
					</a>
				</div>
			</div>
			<!-- Column -->
			
		</div>
		<!-- ============================================================== -->
		<!-- Sales chart -->
	</div>
@endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection
