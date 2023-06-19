@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-hotel') }}" enctype="multipart/form-data">
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
								<input type="text" class="form-control" name="name" id="name" placeholder="Name Here"  value="{{ $hotel->name }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="slug" class="col-sm-3 text-right control-label col-form-label">Slug</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="slug" id="slug" placeholder="Slug Here"  value="{{ $hotel->slug }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="excerpt" class="col-sm-3 text-right control-label col-form-label">Excerpt</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="excerpt"  id="excerpt" placeholder="Enter excerpt Here" >{{ $hotel->excerpt }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="description" id="description" placeholder="Enter description Here" >{{ $hotel->description }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="amenities" class="col-sm-3 text-right control-label col-form-label">Amenities</label>
							<div class="col-sm-9">
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="24X7 Security" {{ (in_array("24X7 Security",  $hotel->amenities))?'checked' : '' }} > 24X7 Security
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="WiFi" {{ (in_array("WiFi",  $hotel->amenities))?'checked' : '' }}> WiFi
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Lift" {{ (in_array("Lift",  $hotel->amenities))?'checked' : '' }}> Lift
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Parking" {{ (in_array("Parking",  $hotel->amenities))?'checked' : '' }}> Parking
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Laundry Service" {{ (in_array("Laundry Service",  $hotel->amenities))?'checked' : '' }}> Laundry Service
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Wardrobe" {{ (in_array("Wardrobe",  $hotel->amenities))?'checked' : '' }}> Wardrobe
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Mineral Water Bottle" {{ (in_array("Mineral Water Bottle",  $hotel->amenities))?'checked' : '' }}> Mineral Water Bottle
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Daily Housekeeping" {{ (in_array("Daily Housekeeping",  $hotel->amenities))?'checked' : '' }}> Daily Housekeeping
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Free Toiletries" {{ (in_array("Free Toiletries",  $hotel->amenities))?'checked' : '' }}> Free Toiletries
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="LCD TV" {{ (in_array("LCD TV",  $hotel->amenities))?'checked' : '' }}> LCD TV
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Clean Towels" {{ (in_array("Clean Towels",  $hotel->amenities))?'checked' : '' }}> Clean Towels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Clean Linen" {{ (in_array("Clean Linen",  $hotel->amenities))?'checked' : '' }}> Clean Linen
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Toilet Paper" {{ (in_array("Toilet Paper",  $hotel->amenities))?'checked' : '' }}> Toilet Paper
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Wake-Up Service" {{ (in_array("Wake-Up Service",  $hotel->amenities))?'checked' : '' }}> Wake-Up Service
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="DTH Channels" {{ (in_array("DTH Channels",  $hotel->amenities))?'checked' : '' }}> DTH Channels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Tile/Marble floor" {{ (in_array("Tile/Marble floor",  $hotel->amenities))?'checked' : '' }}> Tile/Marble floor
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="24-Hour Front Desk" {{ (in_array("24-Hour Front Desk",  $hotel->amenities))?'checked' : '' }}> 24-Hour Front Desk
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Card Payment" {{ (in_array("Card Payment",  $hotel->amenities))?'checked' : '' }}> Card Payment
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire NOC" {{ (in_array("Fire NOC",  $hotel->amenities))?'checked' : '' }}> Fire NOC
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Extinguishers" {{ (in_array("Fire Extinguishers",  $hotel->amenities))?'checked' : '' }}> Fire Extinguishers
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="In-House Kitchen" {{ (in_array("In-House Kitchen",  $hotel->amenities))?'checked' : '' }}> In-House Kitchen
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Smoke Detectors" {{ (in_array("Smoke Detectors",  $hotel->amenities))?'checked' : '' }}> Smoke Detectors
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Exit" {{ (in_array("Fire Exit",  $hotel->amenities))?'checked' : '' }}> Fire Exit
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Fire Hose Reels" {{ (in_array("Fire Hose Reels",  $hotel->amenities))?'checked' : '' }}> Fire Hose Reels
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="FHRAI Certification" {{ (in_array("FHRAI Certification",  $hotel->amenities))?'checked' : '' }}> FHRAI Certification
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="FSSAI Licence" {{ (in_array("FSSAI Licence",  $hotel->amenities))?'checked' : '' }}> FSSAI Licence
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Security Guard" {{ (in_array("Security Guard",  $hotel->amenities))?'checked' : '' }}> Security Guard
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Electric Kettle (On Request)" {{ (in_array("Electric Kettle (On Request)",  $hotel->amenities))?'checked' : '' }}> Electric Kettle (On Request)
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Pickup & Drop (Chargeable)" {{ (in_array("Pickup & Drop (Chargeable)",  $hotel->amenities))?'checked' : '' }}> Pickup & Drop (Chargeable)
								</span>
								<span class="amenities" >
									<input type="checkbox" name="amenities[]" value="Breakfast (Buffet)" {{ (in_array("Breakfast (Buffet)",  $hotel->amenities))?'checked' : '' }}> Breakfast (Buffet)
								</span>
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="address" id="address" placeholder="Enter Address Here" >{{ $hotel->address }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="gmap" class="col-sm-3 text-right control-label col-form-label">Gmap Location</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="gmap" id="gmap" placeholder="Enter Gmap Location Code" >{{ $hotel->gmap }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="lat" class="col-sm-3 text-right control-label col-form-label">Lattitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lat" id="lat" placeholder="Enter Lattitude Here" value="{{ $hotel->lat }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="lng" class="col-sm-3 text-right control-label col-form-label">Longitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lng" id="lng" placeholder="Enter Longitude Here"  value="{{ $hotel->lng }}">
							</div>
						</div>
						
						<div class="form-group row">
							<label for="no_of_module" class="col-sm-3 text-left control-label col-form-label">Gallery</label>
							<div class="col-sm-9">
								<a href="{{ url('gallery') }}/{{ $hotel->id }}" class="btn btn-primary">
									Gallery Detail
								</a>								
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Select State</label>
							<div class="col-sm-9">
								<select name="state_id" id="state_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" onChange="getCitiesByStateId(this);" >	
									<option value="">Select State</option>
									@foreach ($states as $value)
									<option value="{{ $value->id }}" {{ ( $hotel->state_id ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
									@endforeach
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Select City</label>
							<div class="col-sm-9">
								<select name="city_id" id="city_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Select City</option>
									@foreach ($cities as $value)
									<option value="{{ $value->id }}" {{ ( $hotel->city_id ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" {{ ( $hotel->status ==  '1' )? 'selected' : '' }} > Publish</option>
									<option value="0" {{ ( $hotel->status ==  '0' )? 'selected' : '' }}> Private </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-4 text-left control-label col-form-label">Featured Image</label>
							<div class="col-sm-8 text-hotel">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="{{ (isset($hotel->featured_image))?getSizedImage('',$hotel->featured_image):'https://dummyimage.com/250x250?text=Add%20Image' }}" alt="" style="width:100%">
									<input type="hidden" name="featured_image" id="featured_image" value="{{ $hotel->featured_image }}" >	
								</a>	
								@if(isset($hotel->featured_image))
									<a href="javascript:void(0)" class="removeImage" style="color: #c90f0f;font-weight: 600;"> Remove Image </a>	
								@endif					
							</div>
						</div>
					</div>

				</div>
				<h4 class="card-title"> Search Engine Options </h4>
				<div class="row">
					<div class="col-md-7" >
						<div class="form-group row">
							<label for="title" class="col-sm-3 text-right control-label col-form-label">Title</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="title" id="title" placeholder="Title Here" value="{{ $hotel->title }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="meta_description" class="col-sm-3 text-right control-label col-form-label">Meta Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description Here" >{{ $hotel->meta_description }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="schema" class="col-sm-3 text-right control-label col-form-label">Schema Code</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="schema" id="schema" placeholder="Enter Schema Code" >{{ $hotel->schema }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="utm_campaign" class="col-sm-3 text-right control-label col-form-label">Campaign</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_campaign" id="utm_campaign" placeholder="Enter Utm Campaign Here" value="{{ $hotel->utm_campaign }}">
							</div>
						</div>

						<div class="form-group row">
							<label for="utm_source" class="col-sm-3 text-right control-label col-form-label">Source</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_source" id="utm_source" placeholder="Enter Utm Source Here"  value="{{ $hotel->utm_source }}">
							</div>
						</div>

						<div class="form-group row">
							<label for="robots" class="col-sm-3 text-right control-label col-form-label">Robots Content</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="robots" id="robots" placeholder="Enter Hotel Pincode Here" value="{{ $hotel->robots }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="canonical" class="col-sm-3 text-right control-label col-form-label">Cronical Url</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="canonical" id="canonical" placeholder="Enter Hotel Pincode Here" value="{{ $hotel->canonical }}">
							</div>
						</div>
					</div>
					
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}" >
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

