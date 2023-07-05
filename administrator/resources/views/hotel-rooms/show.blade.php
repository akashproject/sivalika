@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-hotel-room') }}" enctype="multipart/form-data">
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
						
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Room Type</label>
							<div class="col-sm-8">
								<select name="room_id" id="room_id" class="select2 form-control custom-select" style="width: 100%;" >	
									<option value="">Select Room Type</option>
									@foreach ($rooms as $room)
									<option value="{{  $room->id }}" {{ ( $room->id ==  $hotelRoom->room_id )? 'selected' : '' }}> {{  $room->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="status" class="col-sm-4 text-right control-label col-form-label">Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="active" {{ ( $hotelRoom->status ==  'active' )? 'selected' : '' }}> Active</option>
									<option value="blocked" {{ ( $hotelRoom->status ==  'blocked' )? 'selected' : '' }}> Blocked </option>
									<option value="not-cleaned" {{ ( $hotelRoom->status ==  'not-cleaned' )? 'selected' : '' }}> Not Cleaned </option>
									<option value="reserved" {{ ( $hotelRoom->status ==  'reserved' )? 'selected' : '' }}> Reserved </option>
								<select>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="hotelRoom_id" id="hotelRoom_id" value="{{ $hotelRoom->id }}" >
					<input type="hidden" name="hotel_room_no" id="hotel_room_no" value="{{ $hotelRoom->hotel_room_no }}" >
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

