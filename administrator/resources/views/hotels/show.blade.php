@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-center') }}" enctype="multipart/form-data">
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
								<input type="text" class="form-control" name="name" id="name" placeholder="Name Here"  value="{{ $center->name }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="slug" class="col-sm-3 text-right control-label col-form-label">Slug</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="slug" id="slug" placeholder="Slug Here"  value="{{ $center->slug }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="excerpt" class="col-sm-3 text-right control-label col-form-label">Excerpt</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="excerpt"  id="excerpt" placeholder="Enter excerpt Here" >{{ $center->excerpt }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="description" id="description" placeholder="Enter description Here" >{{ $center->description }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="highlights" class="col-sm-3 text-right control-label col-form-label">Course highlights</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="highlights" id="highlights" placeholder="Enter Highlights" >{{ $center->highlights }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="courses" class="col-sm-3 text-right control-label col-form-label">Courses</label>
							<div class="col-sm-9">
								<select name="courses[]" id="courses" class="select2 form-control custom-select" style="width: 100%; height:136px;" multiple>	
									<option value="">Select Courses</option>
									@foreach($courseCategories as $category)
									<option value="{{ $category->id }}" {{ (in_array($category->id,  json_decode($center->courses)))?'selected' : '' }} >{{ $category->name }}</option>
									@endforeach
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 text-right control-label col-form-label">Center Email</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="email" id="email" placeholder="Email Address Here" value="{{ $center->email }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-sm-3 text-right control-label col-form-label">Center Mobile</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Center Mobile No Here" value="{{ $center->mobile }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="whatsapp" class="col-sm-3 text-right control-label col-form-label">Center WhatsApp</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Enter Center WhatsApp No Here" value="{{ $center->whatsapp }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="address" id="address" placeholder="Enter Address Here" >{{ $center->address }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="gmap_location" class="col-sm-3 text-right control-label col-form-label">Gmap Location</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="gmap_location" id="gmap_location" placeholder="Enter Gmap Location Code" >{{ $center->gmap_location }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="lat" class="col-sm-3 text-right control-label col-form-label">Lattitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lat" id="lat" placeholder="Enter Lattitude Here" value="{{ $center->lat }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="lng" class="col-sm-3 text-right control-label col-form-label">Longitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lng" id="lng" placeholder="Enter Longitude Here"  value="{{ $center->lng }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="center_pincode" class="col-sm-3 text-right control-label col-form-label">Center's Pincode</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="center_pincode" id="center_pincode" placeholder="Enter Center Pincode Here" value="{{ $center->center_pincode }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="no_of_module" class="col-sm-3 text-left control-label col-form-label">Gallery</label>
							<div class="col-sm-9">
								<a href="{{ url('gallery') }}/{{ $center->id }}" class="btn btn-primary">
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
									<option value="{{ $value->id }}" {{ ( $center->state_id ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
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
									<option value="{{ $value->id }}" {{ ( $center->city_id ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="no_of_module" class="col-sm-3 text-left control-label col-form-label">Pincode</label>
							<div class="col-sm-9">
								<a href="{{ url('pincode') }}/{{ $center->id }}" class="btn btn-primary">
									Import Pincode
								</a>								
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-sm-3 text-right control-label col-form-label">Tags</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="tags" id="meta_description" placeholder="Enter Tags Here" ></textarea>
							</div>
						</div>						
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Enable OTP</label>
							<div class="col-sm-9">
								<select name="enable_otp" id="enable_otp" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Enable Otp</option>
									<option value="1" {{ ( $center->enable_otp ==  '1' )? 'selected' : '' }}> Yes</option>
									<option value="0" {{ ( $center->enable_otp ==  '0' )? 'selected' : '' }}> No </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" {{ ( $center->status ==  '1' )? 'selected' : '' }} > Publish</option>
									<option value="0" {{ ( $center->status ==  '0' )? 'selected' : '' }}> Private </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-4 text-left control-label col-form-label">Featured Image</label>
							<div class="col-sm-8 text-center">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="{{ (isset($center->featured_image))?getSizedImage('',$center->featured_image):'https://dummyimage.com/250x250?text=Add%20Image' }}" alt="" style="width:100%">
									<input type="hidden" name="featured_image" id="featured_image" value="{{ $center->featured_image }}" >	
								</a>	
								@if(isset($center->featured_image))
									<a href="javascript:void(0)" class="removeImage" style="color: #c90f0f;font-weight: 600;"> Remove Image </a>	
								@endif					
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-4 text-left control-label col-form-label">Banner Image</label>
							<div class="col-sm-8 text-center">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="{{ (isset($center->banner_image))?getSizedImage('',$center->banner_image):'https://dummyimage.com/250x250?text=Add%20Image' }}" alt="" style="width:100%">
									<input type="hidden" name="banner_image" id="banner_image" value="{{ $center->banner_image }}" >	
								</a>	
								@if(isset($center->banner_image))
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
								<input type="text" class="form-control" name="title" id="title" placeholder="Title Here" value="{{ $center->title }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="meta_description" class="col-sm-3 text-right control-label col-form-label">Meta Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description Here" >{{ $center->meta_description }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="schema" class="col-sm-3 text-right control-label col-form-label">Schema Code</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="schema" id="schema" placeholder="Enter Schema Code" >{{ $center->schema }}</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="utm_campaign" class="col-sm-3 text-right control-label col-form-label">Campaign</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_campaign" id="utm_campaign" placeholder="Enter Utm Campaign Here" value="{{ $center->utm_campaign }}">
							</div>
						</div>

						<div class="form-group row">
							<label for="utm_source" class="col-sm-3 text-right control-label col-form-label">Source</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_source" id="utm_source" placeholder="Enter Utm Source Here"  value="{{ $center->utm_source }}">
							</div>
						</div>

						<div class="form-group row">
							<label for="robots" class="col-sm-3 text-right control-label col-form-label">Robots Content</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="robots" id="robots" placeholder="Enter Center Pincode Here" value="{{ $center->robots }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="canonical" class="col-sm-3 text-right control-label col-form-label">Cronical Url</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="canonical" id="canonical" placeholder="Enter Center Pincode Here" value="{{ $center->canonical }}">
							</div>
						</div>
					</div>
					
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="center_id" id="center_id" value="{{ $center->id }}" >
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

