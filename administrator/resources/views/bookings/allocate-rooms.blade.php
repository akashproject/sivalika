@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('assign-rooms') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Assign Rooms </h4>
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
				  
                    <a class="nav-link disabled" data-toggle="tab" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Checking Details</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link disabled" data-toggle="tab" href="#guest" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Guest Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#rooms" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Room Allotment</span></a>
                  </li>
                </ul>
				<div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="rooms" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Room Allotment </h4>
							@if($hotelRooms)
								<div class="row" >
									<div class="col-md-9">	
										<div class="card">
											<div class="card-body">
												<div class="row" >
													@foreach($hotelRooms as $hotelroom)
													@php
														$statusColor = ['active'=>'#52b532','blocked'=>'#bcc5b9','not-cleaned'=>'#b7c928','reserved'=>'#f34f6d']
													@endphp
													@if(!array_key_exists($hotelroom->id,$reservedRooms))
													<div class="col-md-2" style="height:80px">
														<label for="{{ $hotelroom->id }}" class="hotelroom" style="background:{{ $statusColor[$hotelroom->status] }}">	
															<span class="room-no" target="_blank" href="{{ url('/view-hotel-room/'.$hotelroom->id) }}">{{ $hotelroom->hotel_room_no }}</span>
															<input type="checkbox" name="hotel_room[]" value="{{ $hotelroom->id }}" {{ (isset($rooms) && in_array($hotelroom->id, $rooms) )?"checked":""}} >
														</label>
													</div>
													@endif
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
				</div>
			</div>

			<div class="border-top">

				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="bookingId" id="bookingId" value="{{$booking_id}}" >
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

