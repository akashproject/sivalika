@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-booking') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> General Options </h4>
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
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
							<div class="col-sm-9">
								<select name="hotel_id" id="hotel_id" class="select2 form-control custom-select" style="width: 100%;">	
									<option value="">Select Hotel</option>
									@foreach ($hotels as $hotel)
									<option value="{{  $hotel->id }}" {{ ( $hotel->id ==  $booking->hotel_id )? 'selected' : '' }}> {{  $hotel->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="guest_name" class="col-sm-3 text-right control-label col-form-label">Rooms</label>
							<div class="col-sm-9 hotelRooms">
								@foreach($booking->rooms as $typeKey => $room)
								<input type="hidden" name="rooms[{{ get_room_by_id($typeKey)->id }}]" >
								<div class="card" style="border: 1px solid #ccc;">
									<div class="card-body">
										<h4 class="card-title text-center">{{ get_room_by_id($typeKey)->name }}</h4>
										<div class="room_type_{{get_room_by_id($typeKey)->id}}" >
											@if($room !== null)
											@foreach($room as $key => $guest)
												<div class="row mt-2">
													<div class="col-sm-5">
														<span class="room-label" >Adult</span>
														<span class="room-guest">
															<input class="form-control" name="rooms[{{$typeKey}}][{{$key}}][adult]" type="number" value="{{$guest['adult']}}" >
														</span>
													</div>
													<div class="col-sm-5">
														<span class="room-label">Child</span>
														<span class="room-guest">
															<input class="form-control" type="number" name="rooms[{{$typeKey}}][{{$key}}][child]" value="{{$guest['child']}}" >
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
											<button type="button" id="room_type_{{get_room_by_id($typeKey)->id}}" class="btn btn-primary addNewRoom" data-id="{{get_room_by_id($typeKey)->id}}" > Add Room </button>
										</div>
									</div>
								</div>
								@endforeach
							</div>
						</div>
						<div class="form-group row">
							<label for="guest_name" class="col-sm-3 text-right control-label col-form-label">Guest Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="guest_name" id="guest_name" placeholder="Enter Guest Here" value="{{$booking->guest_name}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="guest_mobile" class="col-sm-3 text-right control-label col-form-label">Guest Mobile</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="guest_mobile" id="guest_mobile" placeholder="Enter Guest Mobile Number" value="{{$booking->guest_mobile}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="amount" class="col-sm-3 text-right control-label col-form-label">Booking Amount</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Booking Amount" value="{{$booking->amount}}">
							</div>
						</div>
						<div class="form-group row">
							<label for="total_guest" class="col-sm-3 text-right control-label col-form-label">Total Guest</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="total_guest" id="total_guest" placeholder="Enter Total Guest" value="{{$booking->total_guest}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="checkin" class="col-sm-3 text-right control-label col-form-label">Checkin Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="checkin" id="datepicker checkin" placeholder="Enter Checkin Date" value="{{$booking->checkin}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="checkout" class="col-sm-3 text-right control-label col-form-label">Checkout Date</label>
							<div class="col-sm-9">
								<input type="date" class="form-control" name="checkout" id="datepicker checkout" placeholder="Enter Checkout Date" value="{{$booking->checkout}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="order_id" class="col-sm-3 text-right control-label col-form-label">Order id</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="order_id" id="datepicker order_id" placeholder="Enter Payment Getway Order Id" value="{{$booking->order_id}}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="payment_id" class="col-sm-3 text-right control-label col-form-label">Transaction id</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="payment_id" id="payment_id" placeholder="Enter Payment Id" value="{{$booking->payment_id}}" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="payment" class="col-sm-4 text-right control-label col-form-label">Payment Status</label>
							<div class="col-sm-8">
								<select name="payment" id="payment" class="select2 form-control custom-select">	
									<option value="">Update Status</option>
									<option value="pending" {{ ( $booking->payment ==  'pending' )? 'selected' : '' }} > Pending</option>
									<option value="success" {{ ( $booking->payment ==  'success' )? 'selected' : '' }}> Success </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-4 text-right control-label col-form-label">Booking Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select">	
									<option value="">Update Status</option>
									<option value="comfirm" {{ ( $booking->status ==  'comfirm' )? 'selected' : '' }} > Comfirm</option>
									<option value="pending" {{ ( $booking->status ==  'pending' )? 'selected' : '' }}> Pending </option>
									<option value="cancel" {{ ( $booking->status ==  'cancel' )? 'selected' : '' }}> Cancel </option>
								<select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="booking_id" id="booking_id" value="{{ $booking->id }}" >
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

