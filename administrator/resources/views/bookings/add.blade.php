@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-booking') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Booking </h4>
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				@if(session()->has('message'))
					<div class="alert alert-success">
						{{ session()->get('message') }}
					</div>
				@endif
				<div class="row">
					<div class="col-md-7" >
						<div class="form-group row">
							<label for="checkin" class="col-sm-3 text-right control-label col-form-label">Checkin Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="checkin" id="datepicker checkin" placeholder="Enter Checkin Date" >
							</div>
						</div>
						<div class="form-group row">
							<label for="checkout" class="col-sm-3 text-right control-label col-form-label">Checkout Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="checkout" id="datepicker checkout" placeholder="Enter Checkout Date" >
							</div>
						</div>
						<div class="form-group row">
							<label for="total_guest" class="col-sm-3 text-right control-label col-form-label">Total Guest</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="total_guest" id="total_guest" placeholder="Enter Total Guest" >
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
							<div class="col-sm-9">
								<select name="hotel_id" id="hotel_id" class="select2 form-control custom-select" style="width: 100%;" onChange="getRoomsByHotelId(this);">	
									<option value="">Select Hotel</option>
									@foreach ($hotels as $hotel)
									<option value="{{  $hotel->id }}" > {{  $hotel->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="guest_name" class="col-sm-3 text-right control-label col-form-label">Rooms</label>
							<div class="col-sm-9 hotelRooms">
								
							</div>
						</div>
						<div class="form-group row">
							<label for="guest_name" class="col-sm-3 text-right control-label col-form-label">Guest Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="guest_name" id="guest_name" placeholder="Enter Guest Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="guest_mobile" class="col-sm-3 text-right control-label col-form-label">Guest Mobile</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="guest_mobile" id="guest_mobile" placeholder="Enter Guest Mobile Number" >
							</div>
						</div>
						<div class="form-group row">
							<label for="amount" class="col-sm-3 text-right control-label col-form-label">Booking Amount</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Booking Amount" >
							</div>
						</div>
						
						<div class="form-group row">
							<label for="order_id" class="col-sm-3 text-right control-label col-form-label">Order id</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="order_id" id="datepicker order_id" placeholder="Enter Payment Getway Order Id" >
							</div>
						</div>
						<div class="form-group row">
							<label for="payment_id" class="col-sm-3 text-right control-label col-form-label">Payment id</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="payment_id" id="payment_id" placeholder="Enter Payment Id" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Payment Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="pending" > Pending</option>
									<option value="success" > Success </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Booking Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="pending" > Pending</option>
									<option value="comfirm" > Comfirm</option>
									<option value="cancel" > Cancel </option>
								<select>
							</div>
						</div>
					</div>
				</div>				
			</div>

			<div class="border-top">

				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="booking_id" id="booking_id" value="" >
				</div>

			</div>

		</form>

	</div>
</div>              

@endsection

@section('script')

<!-- ============================================================== -->

<!-- CHARTS -->

@endsection

