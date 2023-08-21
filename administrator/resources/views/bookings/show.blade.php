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
		<form class="form-horizontal" method="post" action="{{ url('save-booking') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Booking #{{ $booking->booking_id }}</h4>
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
                    <a class="nav-link" href="{{ url('add-guests/'.$booking->bookingId)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Guest Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('allocate-rooms/'.$booking->bookingId)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Room Allotment</span></a>
                  </li>
                </ul>
				<div class="tab-content tabcontent-border">
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
											@foreach($booking->rooms as $typeKey => $rooms)
											<input type="hidden" name="rooms[{{ $typeKey }}]" >
											<div class="card" style="border: 1px solid #ccc;">
												<div class="card-body">
													<h4 class="card-title text-center">{{ get_room_by_id($typeKey)->name }}</h4>
													<div class="room_type_{{$typeKey}}" >
														@php
														$i = 0;
														@endphp	
														@if(!empty($rooms))
														@foreach($rooms as $room)
															<div class="row mt-2">
																<div class="col-sm-5">
																	<span class="room-label">Adult</span>
																	<span class="room-guest">
																		<input value="{{ ($booking->total_guest < $room['adult'])?$booking->total_guest:$room['adult'] }}" class="form-control" name="rooms[{{$typeKey}}][{{$i}}][adult]" type="number" min="1" max="{{ get_room_by_id($typeKey)->person }}">
																	</span>
																</div>
																<div class="col-sm-5">
																	<span class="room-label">Child</span>
																	<span class="room-guest">
																		<input class="form-control" type="number" name="rooms[{{$typeKey}}][{{$i}}][child]" value="0" max="2">
																	</span>
																</div>
																<div class="col-sm-2">
																	<button type="button" class="btn btn-danger btn remove-room"><i class="mdi mdi-delete"></i></button>
																</div>
															</div>
															
														@endforeach
														@endif
													</div>
													<div class="row mt-2 text-right">
														<button type="button" id="room_type_{{$typeKey}}" data-roomcount="{{ get_room_by_id($typeKey)->room_count }}" class="btn btn-primary addNewRoom" data-id="{{$typeKey}}"> Add Room </button>
													</div>
												</div>
											</div>
											@endforeach
										@endif
										</div>
									</div>
									
									<div class="form-group row">
										<label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
										<div class="col-sm-9">
											<select name="gender" id="gender" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="male" {{ ( 'male' ==  $booking->gender )? 'selected' : '' }}> Male </option>
												<option value="female" {{ ( 'female' ==  $booking->gender )? 'selected' : '' }}> Female </option>
												<option value="other" {{ ( 'other' ==  $booking->gender )? 'selected' : '' }}> Other </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="amount" class="col-sm-3 text-right control-label col-form-label">Booking Amount</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Booking Amount" value="{{$booking->amount}}" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="purpose" class="col-sm-3 text-right control-label col-form-label">Visit Purpose</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="purpose" id="purpose" placeholder="Enter Purpose of visit" value="{{$booking->purpose}}" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="order_id" class="col-sm-3 text-right control-label col-form-label">Order id</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="order_id" id="datepicker order_id" placeholder="Enter Payment Getway Order Id" value="{{$booking->order_id}}" >
										</div>
									</div>
									<div class="form-group row">
										<label for="payment_id" class="col-sm-3 text-right control-label col-form-label">Payment id</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="payment_id" id="payment_id" placeholder="Enter Payment Id" value="{{$booking->payment_id}}">
										</div>
									</div>
								</div>
								<div class="col-md-5">
									<div class="form-group row">
										<label for="payment_type" class="col-sm-4 text-right control-label col-form-label">Payment Type</label>
										<div class="col-sm-8">
											<select name="payment_type" id="payment_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="" > Select Payment Type</option>
												<option value="Cash" {{ ( 'Cash' ==  $booking->payment_type )? 'selected' : '' }}> Cash</option>
												<option value="Upi" {{ ( 'Upi' ==  $booking->payment_type )? 'selected' : '' }} > Upi </option>
												<option value="Bank Transfer" {{ ( 'Bank Transfer' ==  $booking->payment_type )? 'selected' : '' }} > Bank Transfer </option>
												<option value="Card Mechine" {{ ( 'Card Mechine' ==  $booking->payment_type )? 'selected' : '' }} > Card Mechine </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="state" class="col-sm-4 text-right control-label col-form-label">Payment Status</label>
										<div class="col-sm-8">
											<select name="payment" id="payment" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="" > Select Payment Status</option>
												<option value="pending" {{ ( 'pending' ==  $booking->payment )? 'selected' : '' }} > Pending</option>
												<option value="success" {{ ( 'success' ==  $booking->payment )? 'selected' : '' }} > Success </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="booking_type" class="col-sm-4 text-right control-label col-form-label">Booking Type</label>
										<div class="col-sm-8">
											<select name="booking_type" id="booking_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="Walking" {{ ( 'Walking' ==  $booking->booking_type )? 'selected' : '' }} >Walking</option>
												<option value="Phone Call" {{ ( 'Phone Call' ==  $booking->booking_type )? 'selected' : '' }} >Phone Call</option>
												<option value="Website" {{ ( 'Website' ==  $booking->booking_type )? 'selected' : '' }} >Website</option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="state" class="col-sm-4 text-right control-label col-form-label">Booking Status</label>
										<div class="col-sm-8">
											<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>	
												<option value="pending" {{ ( 'pending' ==  $booking->bookingStatus )? 'selected' : '' }} > Pending</option>
												<option value="comfirm" {{ ( 'comfirm' ==  $booking->bookingStatus )? 'selected' : '' }} > Comfirm</option>
												<option value="arrvied" {{ ( 'arrvied' ==  $booking->bookingStatus )? 'selected' : '' }} > Arrived</option>
												<option value="cancel" {{ ( 'cancel' ==  $booking->bookingStatus )? 'selected' : '' }} > Cancel </option>
												<option value="completed" {{ ( 'completed' ==  $booking->bookingStatus )? 'selected' : '' }} > Completed </option>
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
					<input type="hidden" name="bookingId" id="bookingId" value="{{$booking->id}}" >
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

