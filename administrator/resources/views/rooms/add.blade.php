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
									<input type="checkbox" name="amenities[]" value="WiFi" checked> WiFi
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Wardrobe" checked> Wardrobe
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Mineral Water Bottle" checked> Mineral Water Bottle
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
									<input type="checkbox" name="amenities[]" value="DTH Channels" checked> DTH Channels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Tile/Marble floor" checked> Tile/Marble floor
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Electric Kettle (On Request)" checked> Electric Kettle (On Request)
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
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" > Publish</option>
									<option value="0" > Private </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-6 text-left control-label col-form-label">Featured Image</label>
							<div class="col-sm-6 text-center">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="https://dummyimage.com/150x150?text=Add%20Image" alt="">
									<input type="hidden" name="featured_image" id="featured_image" value="" >	
								</a>	
								@if(isset($room->featured_image))
									<a href="javascript:void(0)" class="removeImage" style="color: #c90f0f;font-weight: 600;"> Remove Image </a>	
								@endif
							</div>
						</div>
					</div>

				</div>				
			</div>

			<div class="border-top">

				<div class="card-body">

					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="room_id" id="room_id" value="" >
					<input type="hidden" name="hotel_id" id="hotel_id" value="{{$hotel_id}}" >
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

