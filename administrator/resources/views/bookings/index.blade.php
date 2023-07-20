@extends('layouts.admin')



@section('content')

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
									<a href="{{ url('/view-booking/'.$value->id) }}" class="btn btn-success"> Checkin </a>
									<a href="{{ url('/add-guests/'.$value->id) }}" class="btn btn-primary"> Guests </a>
									<a href="{{ url('/allocate-rooms/'.$value->id) }}" class="btn btn-danger"> Rooms </a>
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

@endsection

@section('script')

<!-- ============================================================== -->

<!-- CHARTS -->

@endsection

