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
								<input type="date" class="form-control" name="checkin" id="datepicker checkin" value="{{$filterData['checkin']}}" placeholder="Enter Checkin Date" required>
							</div>
						</div>
					</div>
					<div class="col-md-4" >
						<div class="form-group row">
							<label for="checkout" class="col-sm-5 text-left control-label col-form-label">Checkout</label>
							<div class="col-sm-7">
								<input type="date" class="form-control" name="checkout" id="datepicker checkout" value="{{$filterData['checkout']}}" placeholder="Enter Checkout Date" required>
							</div>
						</div>
					</div>
					<div class="col-md-3" >
						<div class="form-group row">
							<label for="total_guest" class="col-sm-5 text-left control-label col-form-label">Guest</label>
							<div class="col-sm-7">
								<input type="number" class="form-control" name="total_guest" id="total_guest" value="{{$filterData['total_guest']}}" placeholder="Total Guest">
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
				  
                    <a class="nav-link active" data-toggle="tab" href="#checking" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Checking Details</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link disabled" data-toggle="tab" href="#guest" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Guest Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" data-toggle="tab" href="#rooms" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Room Allotment</span></a>
                  </li>
                </ul>
				<div class="tab-content tabcontent-border">
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
										@php
											$cost = 0;
										@endphp
											@foreach($rooms as $typeKey => $room)
											@php 
												$roomCount = $filterData['total_guest']/$room->person;
												$roomCount = ($filterData['total_guest']%$room->person != 0)?$roomCount+1:$roomCount;
											@endphp											
											<input type="hidden" name="rooms[{{ $room->id }}]" >
											<div class="card" style="border: 1px solid #ccc;">
												<div class="card-body">
													<h4 class="card-title text-center">{{ $room->name }}</h4>
													<div class="room_type_{{$room->id}}" >
														@for($i = 1; $i<=$roomCount;$i++)
															
															<div class="row mt-2">
																<div class="col-sm-5">
																	<span class="room-label">Adult</span>
																	<span class="room-guest">
																		<input value="{{ ($filterData['total_guest'] < $room->person)?$filterData['total_guest']:$room->person }}" class="form-control" name="rooms[{{$room->id}}][{{$i}}][adult]" type="number" min="1" max="{{ $room->person }}">
																	</span>
																</div>
																<div class="col-sm-5">
																	<span class="room-label">Child</span>
																	<span class="room-guest">
																		<input class="form-control" type="number" name="rooms[{{$room->id}}][{{$i}}][child]" value="0" max="2">
																	</span>
																</div>
																<div class="col-sm-2">
																	<button type="button" class="btn btn-danger btn remove-room"><i class="mdi mdi-delete"></i></button>
																</div>
															</div>
															@php
																$cost += $room->cost;
																$room->room_count-- ;
																$filterData['total_guest'] -= $room->person;
															@endphp
															@if($room->room_count < 1)
																@break;
															@endif
														@endfor
													</div>
													<div class="row mt-2 text-right">
														<button type="button" id="room_type_{{$room->id}}" data-roomcount="{{ $room->room_count }}" class="btn btn-primary addNewRoom" data-id="{{$room->id}}"> Add Room </button>
													</div>
												</div>
											</div>
											@endforeach	
											@if($filterData['total_guest'] > 1)
											<div class="card" style="border: 1px solid #ccc;">
												<div class="card-body">
													<h4 class="card-title text-center">{{$filterData['total_guest']}} Guest Extra</h4>
												</div>
											</div>
											@endif
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
											<input type="text" value="{{$cost}}" class="form-control" name="amount" id="amount" placeholder="Enter Booking Amount" required>
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

