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
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here" value="{{ $booking->name }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="size" class="col-sm-3 text-right control-label col-form-label">Booking Size</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="size" id="size" value="{{ $booking->size }}" placeholder="Enter Booking Size in sq ft" >
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
								<input type="text" class="form-control" name="person" id="person" placeholder="Enter Maximum Person Here" value="{{ $booking->person }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="booking_count" class="col-sm-3 text-right control-label col-form-label">Number of Booking in this type</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="booking_count" id="booking_count" placeholder="Enter Number of Booking" value="{{ $booking->booking_count }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="cost" class="col-sm-3 text-right control-label col-form-label"> Cost Per Night</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="cost" id="cost" placeholder="Enter Cost Per Night" value="{{ $booking->cost }}" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-4 text-right control-label col-form-label">Status</label>
							<div class="col-sm-8">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" {{ ( $booking->status ==  '1' )? 'selected' : '' }} > Publish</option>
									<option value="0" {{ ( $booking->status ==  '0' )? 'selected' : '' }}> Private </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-4 text-left control-label col-form-label">Featured Image</label>
							<div class="col-sm-8 text-left">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="{{ (isset($booking->featured_image))?getSizedImage('',$booking->featured_image):'https://dummyimage.com/250x250?text=Add%20Image' }}" alt="" style="width:100%">
									<input type="hidden" name="featured_image" id="featured_image" value="{{ $booking->featured_image }}" >	
								</a>	
								@if(isset($booking->featured_image))
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

