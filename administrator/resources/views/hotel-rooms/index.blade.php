@extends('layouts.admin')



@section('content')

<div class="col-12">
	<div class="row">
		<div class="card col-12">
			<form class="form-horizontal" method="get" action="{{ url('hotel-rooms') }}" enctype="multipart/form-data">
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
	@if($rooms)
		<div class="row" >
			<div class="col-md-9">	
				<div class="card">
					<div class="card-body">
						<div class="row" >
						@foreach ($rooms as $value)
							<div class="col-md-2" style="height:80px">	
								@php
									$statusColor = ['active'=>'#52b532','blocked'=>'#bcc5b9','not-cleaned'=>'#b7c928','reserved'=>'#f34f6d']
								@endphp
								@if(array_key_exists($value->id,$reservedRooms))
								@php
								$value->status = 'reserved';
								@endphp
								@endif
								<div class="hotelroom" style="background:{{ $statusColor[$value->status] }}">	
									<a class="room-no" target="_blank" href="{{ url('/view-hotel-room/'.$value->id) }}">
										{{ $value->hotel_room_no }}
									</a>
									@if(array_key_exists($value->id,$reservedRooms))
										<div style="padding: 7px 0;">
											<a style="color:#fff" target="_blank" href="{{url('/view-booking/'.$reservedRooms[$value->id]['booking_id'])}}" > {{ $reservedRooms[$value->id]['name'] }} </a>
										</div >	
									@endif
								</div>
							</div>
							@endforeach		
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-3">	
				<div class="card">
					<div class="card-body">
						<p> <span class="color-code" style="background:#52b532"> </span> Available </p>
						<p> <span class="color-code" style="background:#b7c928"> </span>Not Cleaned </p>
						<p> <span class="color-code" style="background:#bcc5b9"> </span>Blocked </p>
						<p> <span class="color-code" style="background:#f34f6d"> </span> Reserved ( {{ count($reservedRooms) }} )</p>
					</div>
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

