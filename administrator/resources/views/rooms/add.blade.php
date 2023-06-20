@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-room') }}" enctype="multipart/form-data">
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
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="size" class="col-sm-3 text-right control-label col-form-label">Room Size</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="size" id="size" placeholder="Enter Room Size in sq ft" >
							</div>
						</div>
						<div class="form-group row">
							<label for="amenities" class="col-sm-3 text-right control-label col-form-label">Amenities</label>
							<div class="col-sm-9">
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="24X7 Security" checked> 24X7 Security
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="WiFi" checked> WiFi
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Lift" checked> Lift
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Parking" checked> Parking
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Laundry Service" checked> Laundry Service
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Wardrobe" checked> Wardrobe
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Mineral Water Bottle" checked> Mineral Water Bottle
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Daily Housekeeping" checked> Daily Housekeeping
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Free Toiletries" checked> Free Toiletries
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="LCD TV" checked> LCD TV
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Clean Towels" checked> Clean Towels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Clean Linen" checked> Clean Linen
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Toilet Paper" checked> Toilet Paper
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Wake-Up Service" checked> Wake-Up Service
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="DTH Channels" checked> DTH Channels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Tile/Marble floor" checked> Tile/Marble floor
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="24-Hour Front Desk" checked> 24-Hour Front Desk
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Card Payment" checked> Card Payment
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire NOC" checked> Fire NOC
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Extinguishers" checked> Fire Extinguishers
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="In-House Kitchen" checked> In-House Kitchen
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Smoke Detectors" checked> Smoke Detectors
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Exit" checked> Fire Exit
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Hose Reels" checked> Fire Hose Reels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="FHRAI Certification" checked> FHRAI Certification
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="FSSAI Licence" checked> FSSAI Licence
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Security Guard" checked> Security Guard
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Electric Kettle (On Request)" checked> Electric Kettle (On Request)
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Pickup & Drop (Chargeable)" checked> Pickup & Drop (Chargeable)
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Breakfast (Buffet)" checked> Breakfast (Buffet)
								</span>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="person" class="col-sm-3 text-right control-label col-form-label">Maximum Person</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="person" id="person" placeholder="Enter Maximum Person Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="room_count" class="col-sm-3 text-right control-label col-form-label">Number of Room in this type</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="room_count" id="room_count" placeholder="Enter Number of Room" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" > Publish</option>
									<option value="0" > Private </option>
								<select>
							</div>
						</div>
					</div>

				</div>				
			</div>

			<div class="border-top">

				<div class="card-body">

					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="room_id" id="room_id" value="" >
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

