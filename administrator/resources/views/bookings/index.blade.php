@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($bookings)

		<div class="card">

			<div class="card-body">

				<h5 class="card-title">
					<a href="{{ url('add-booking/') }}" class="btn btn-primary"> Create New Booking </a>
				</h5>

				<div class="table-responsive">

					<table id="zero_config" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Hotel</th>
								<th>User</th>
								<th>Name</th>
								<th>Mobile</th>
								<th>Amount</th>
								<th>Payment Status</th>
								<th>Options</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($bookings as $value)
							<tr>												
								<td>{{ $value->hotel_id }}</td>													
								<td>{{ $value->user_id }}</td>													
								<td>{{ $value->guest_name }}</td>													
								<td>{{ $value->guest_mobile }}</td>
								<td>Rs. {{ $value->amount }}/-</td>														
								<td>{{ $value->payment }}</td>							
								<td>
									<a href="{{ url('view-booking') }}/{{ $value->id }}" class="btn btn-primary btn-lg">Edit</a>
									<a href="{{ url('delete-booking') }}/{{ $value->id }}" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure?')"; >Delete </a>
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

