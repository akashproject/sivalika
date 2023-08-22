@extends('layouts.admin')



@section('content')

<div class="col-12">
	<div class="row">
		<div class="card col-12">
			<form class="form-horizontal" method="get" action="{{ url('bookings') }}" enctype="multipart/form-data">
				<div class="card-body">
					<h4 class="card-title"> Filter By Date</h4>
					<div class="row">
						<div class="col-md-4" >
							<div class="form-group row">
								<label for="checkin" class="col-sm-4 text-left control-label col-form-label">Checkin</label>
								<div class="col-sm-8">
									<input type="date" class="form-control" name="checkin" id="datepicker checkin" value="" placeholder="Enter Checkin Date" required>
								</div>
							</div>
						</div>
						<div class="col-md-2" >
							<div class="form-group row">
								<button type="submit" class="btn btn-primary">View Details</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			@if($bookings)

				<div class="card">

					<div class="card-body">

						<h5 class="card-title">
							@if($user->role == 2)
							<a href="{{ url('/add-booking-from-front-desk') }}" class="btn btn-success"> New Checkin </a>
							@else
							<a href="{{ url('/add-booking') }}" class="btn btn-primary"> Create New Booking </a>
							@endif
						</h5>

						<div class="table-responsive">
							<table id="zero_config" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Booking</th>
										<th>Hotel</th>
										<th>Name</th>
										<th>Mobile</th>
										<th>Amount</th>
										<th>Payment</th>
										<th>Status</th>
										<th>Options</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($bookings as $value)
									<tr>												
										<td>{{ $value->booking_id }}</td>													
										<td>{{ $value->hotel }}</td>													
										<td>{{ get_customer_by_id($value->user_id)->name }}</td>													
										<td>{{ $value->mobile }}</td>
										<td>Rs. {{ $value->amount }}/-</td>
										<td>{{ $value->payment }}</td>							
										<td>{{ $value->status }}</td>							
										<td>
											@if($user->role == 2)
											<a href="{{ url('/view-booking/'.$value->id) }}" class="btn btn-primary"> View </a>
											<div style="display: inline-block;">
												<select name="status" id="status" class="select2 form-control change-status" style="width: 100%; height:38px;" onChange="changeBookingStatus(this,{{$value->id}});">
													<option value="pending" {{ ( 'pending' ==  $value->status )? 'selected' : '' }} > Pending</option>
													<option value="comfirm" {{ ( 'comfirm' ==  $value->status )? 'selected' : '' }} > Comfirm</option>
													<option value="arrvied" {{ ( 'arrvied' ==  $value->status )? 'selected' : '' }} > Arrived</option>
													<option value="cancel" {{ ( 'cancel' ==  $value->status )? 'selected' : '' }} > Cancel </option>
													<option value="completed" {{ ( 'completed' ==  $value->status )? 'selected' : '' }} > Completed </option>
												<select>
											</div>
											@else
											<a href="{{ url('view-booking') }}/{{ $value->id }}" class="btn btn-primary">Edit</a>
											@endif
										</td>
									</tr>
									@endforeach							
								</tbody>
							</table>
						</div>
					</div>

				</div>

			@endif
		</div>
	</div>
</div>                   

@endsection

@section('script')

<!-- ============================================================== -->

<!-- CHARTS -->

@endsection

