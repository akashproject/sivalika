@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('check-availability') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Booking Date</h4>
				<div class="row">
					<div class="col-md-3" >
						<div class="form-group row">
							<label for="checkin" class="col-sm-4 text-left control-label col-form-label">Checkin</label>
							<div class="col-sm-8">
								<input type="date" class="form-control" name="checkin" id="datepicker checkin" placeholder="Enter Checkin Date" required>
							</div>
						</div>
					</div>
					<div class="col-md-4" >
						<div class="form-group row">
							<label for="checkout" class="col-sm-5 text-left control-label col-form-label">Checkout</label>
							<div class="col-sm-7">
								<input type="date" class="form-control" name="checkout" id="datepicker checkout" placeholder="Enter Checkout Date" required>
							</div>
						</div>
					</div>
					<div class="col-md-3" >
						<div class="form-group row">
							<label for="total_guest" class="col-sm-5 text-left control-label col-form-label">Guest</label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="total_guest" id="total_guest" value="1" placeholder="Total Guest">
							</div>
						</div>
					</div>
					<div class="col-md-2" >
						<div class="form-group row">
							<button type="submit" class="btn btn-primary">Check Availibity</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-front-desk-booking') }}" enctype="multipart/form-data">
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
				<ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
				  
                    <a class="nav-link {{ ($tab == '') ? 'active' : 'disabled' }}" data-toggle="tab" href="#checking" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Checking Details</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link {{ ($tab == 'guest') ? 'active' : 'disabled' }}" data-toggle="tab" href="#guest" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Guest Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ ($tab == 'rooms') ? 'active' : 'disabled' }}" data-toggle="tab" href="#rooms" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Room Allotment</span></a>
                  </li>
                </ul>
				<div class="tab-content tabcontent-border">
					@if($tab == '')
					<input type="hidden" name="tab" value="checkin" >
					<div class="tab-pane active" id="checkin" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Checking Details </h4>
							<div class="row">
								<div class="col-md-7" >
									<div class="form-group row">
										<label for="guest_name" class="col-sm-3 text-right control-label col-form-label">Rooms</label>
										<div class="col-sm-9 hotelRooms">
										@if($rooms)
											@foreach ($rooms as $typeKey => $room)
											<input type="hidden" name="rooms[{{ $room->id }}]" >
											<div class="card" style="border: 1px solid #ccc;">
												<div class="card-body">
													<h4 class="card-title text-center">{{ $room->name }}</h4>
													<div class="room_type_{{$room->id}}" >
														<div class="row mt-2">
															<div class="col-sm-5">
																<span class="room-label">Adult</span>
																<span class="room-guest">
																	<input class="form-control" name="rooms[{{$room->id}}][1][adult]" type="number" value="1" min="1" max="{{ $room->person }}">
																</span>
															</div>
															<div class="col-sm-5">
																<span class="room-label">Child</span>
																<span class="room-guest">
																	<input class="form-control" type="number" name="rooms[{{$room->id}}][1][child]" value="0" max="2">
																</span>
															</div>
															<div class="col-sm-2">
																<button type="button" class="btn btn-danger btn remove-room"><i class="mdi mdi-delete"></i></button>
															</div>
														</div>
													</div>
													<div class="row mt-2 text-right">
														<button type="button" id="room_type_{{$room->id}}" data-roomcount="{{ $room->room_count }}" class="btn btn-primary addNewRoom" data-id="{{$room->id}}"> Add Room </button>
													</div>
												</div>
											</div>
											@endforeach	
										@endif
										</div>
									</div>
									<div class="form-group row">
										<label for="name" class="col-sm-3 text-right control-label col-form-label">User Name</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="name" id="name" placeholder="Enter Guest Here" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="mobile" class="col-sm-3 text-right control-label col-form-label">User Mobile</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Guest Mobile Number" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="email" class="col-sm-3 text-right control-label col-form-label">User Email</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="email" id="email" placeholder="Enter Guest Email Address" >
										</div>
									</div>
									<div class="form-group row">
										<label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
										<div class="col-sm-9">
											<select name="gender" id="gender" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="male" > Male </option>
												<option value="female" > Female </option>
												<option value="other" > Other </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="amount" class="col-sm-3 text-right control-label col-form-label">Booking Amount</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Booking Amount" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="purpose" class="col-sm-3 text-right control-label col-form-label">Visit Purpose</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="purpose" id="purpose" placeholder="Enter Purpose of visit" required>
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
										<label for="payment_type" class="col-sm-4 text-right control-label col-form-label">Payment Type</label>
										<div class="col-sm-8">
											<select name="payment_type" id="payment_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="" > Select Payment Type</option>
												<option value="Cash" > Cash</option>
												<option value="Upi" > Upi </option>
												<option value="Bank Transfer" > Bank Transfer </option>
												<option value="Card Mechine" > Card Mechine </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="state" class="col-sm-4 text-right control-label col-form-label">Payment Status</label>
										<div class="col-sm-8">
											<select name="payment" id="payment" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="" > Select Payment Status</option>
												<option value="pending" > Pending</option>
												<option value="success" > Success </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="booking_type" class="col-sm-4 text-right control-label col-form-label">Booking Type</label>
										<div class="col-sm-8">
											<select name="booking_type" id="booking_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="Walking" >Walking</option>
												<option value="Phone Call" >Phone Call</option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="state" class="col-sm-4 text-right control-label col-form-label">Booking Status</label>
										<div class="col-sm-8">
											<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="pending" > Pending</option>
												<option value="comfirm" > Comfirm</option>
												<option value="arrvied" > Arrived</option>
												<option value="cancel" > Cancel </option>
											<select>
										</div>
									</div>
								</div>
							</div>				
						</div>
					</div>
					@endif	
					@if($tab == 'guest')
					<input type="hidden" name="tab" value="guest" >
					<div class="tab-pane active" id="guest" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Guest Details </h4>
							@for($i=1; $i<=$guests; $i++)
							<div class="row guest_row">
								<label class="col-sm-1 text-right control-label col-form-label">Guest {{$i}}: </label>
								<div class="col-md-11">
									<div class="form-group row mb-4">											
										<div class="col-sm-2 mb-2">
											<label for="guest_name" class="">Enter Name :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][name]" id="guest_name" >
										</div>
										<div class="col-sm-2">
											<label for="dob" class="">Enter DOB :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][dob]" id="dob" >
										</div>		
										<div class="col-sm-2">
											<label for="gander" class="">Select Gander :</label>
											<select name="guest[{{$i}}][gender]" id="gender" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="male" > Male </option>
												<option value="female" > Female </option>
												<option value="other" > Other </option>
											<select>
										</div>
										<div class="col-sm-2">
											<label for="address" class="">Enter Address :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][address]" id="address" >
										</div>
										<div class="col-sm-2">
											<label for="city" class="">Enter City :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][city]" id="city">
										</div>		
										<div class="col-sm-2">
											<label for="state" class="">Enter State :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][state]" id="state">
										</div>
										<div class="col-sm-2">
											<label for="pincode" class="">Enter Pincode :</label>
											<input type="text" class="form-control" name="guest[{{$i}}][pincode]" id="pincode">
										</div>	
										<div class="col-sm-2">
											<label for="nationality" class="">Nationality :</label>
											<select name="guest[{{$i}}][nationality]" id="nationality" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="Indian" > Indian </option>
												<option value="Foreigner" > Foreigner </option>
											<select>
										</div>	
										<div class="col-sm-2">
											<label for="identity_type" class="">Select Identity :</label>
											<select name="guest[{{$i}}][identity_type]" id="identity_type" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="Aadhar Card" > Aadhar Card </option>
												<option value="Voter Card" > Voter Card </option>
												<option value="Driving Licence" > Driving Licence </option>
												<option value="Passport" > Passport </option>
											<select>
										</div>
										<div class="col-sm-2 text-center">
											<label for="identity" class="">Identity Number</label>
											<input type="text" class="form-control" name="guest[{{$i}}][identity]" id="identity" placeholder="Identity Number">
										</div>		
										<div class="col-sm-2">
											<label for="identity" class="">Identity Image</label>
											<input type="file" class="form-control" name="guest[{{$i}}][identity_image]" id="identity_image" placeholder="Identity Image">
										</div>				
									</div>
								</div>
							</div>
							@endfor
										
						</div>
					</div>
					@endif
					@if($tab == 'rooms')
					<input type="hidden" name="tab" value="rooms" >
					<div class="tab-pane active" id="rooms" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Room Allotment </h4>
							@if($rooms)
								<div class="row" >
									<div class="col-md-9">	
										<div class="card">
											<div class="card-body">
												<div class="row" >
												@foreach ($hotelRooms as $hotelroom)
													<div class="col-md-2" style="height:80px">	
														@php
															$statusColor = ['active'=>'#52b532','blocked'=>'#bcc5b9','not-cleaned'=>'#b7c928','reserved'=>'#f34f6d']
														@endphp
														<label for="{{ $hotelroom->id }}" class="hotelroom" style="background:{{ $statusColor[$hotelroom->status] }}">	
															<span class="room-no" target="_blank" href="{{ url('/view-hotel-room/'.$hotelroom->id) }}">{{ $hotelroom->hotel_room_no }}</span>
															<input type="checkbox" name="hotel_room[]" value="{{ $hotelroom->id }}" >
														</label>
													</div>
													@endforeach		
												</div>
											</div>

										</div>
									</div>
									<div class="col-md-3">	
										<div class="card">
											<div class="card-body">
												<p> <span class="color-code" style="background:#52b532"> </span> Active </p>
												<p> <span class="color-code" style="background:#b7c928"> </span>Not Cleaned </p>
												<p> <span class="color-code" style="background:#bcc5b9"> </span>Blocked </p>
												<p> <span class="color-code" style="background:#f34f6d"> </span> Reserved </p>
											</div>
										</div>
									</div>
								</div>

							@endif
						</div>
					</div>
					@endif
				</div>
			</div>

			<div class="border-top">

				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="hotel_id" id="hotel_id" value="{{$hotel->id}}" >
					<input type="hidden" name="bookingId" id="bookingId" value="" >
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

