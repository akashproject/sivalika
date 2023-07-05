@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-hotel-room') }}">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Room </h4>
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
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Room Type</label>
							<div class="col-sm-9">
								<select name="room_id" id="room_id" class="select2 form-control custom-select" style="width: 100%;" >	
									<option value="">Select Room Type</option>
									@foreach ($rooms as $room)
									<option value="{{  $room->id }}" > {{  $room->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="hotel_room_no" class="col-sm-3 text-right control-label col-form-label">Room No</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="hotel_room_no" id="hotel_room_no" placeholder="Enter Room No" >
							</div>
						</div>						
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="active" > Active</option>
									<option value="blocked" > Blocked </option>
									<option value="not-cleaned" > Not Cleaned </option>
									<option value="reserved" > Reserved </option>
								<select>
							</div>
						</div>
					</div>

				</div>				
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="hotelRoom_id" id="hotelRoom_id" value="" >
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

