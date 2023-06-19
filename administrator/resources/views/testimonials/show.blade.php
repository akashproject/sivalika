@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-testimonial') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Testimonial </h4>
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
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here" value="{{ $testimonial->name }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="comment" class="col-sm-3 text-right control-label col-form-label">Comment</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="comment"  id="mceEditor" placeholder="Enter comment Here" >
								{!! $testimonial->comment !!}
								</textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="dasignation" class="col-sm-3 text-right control-label col-form-label">Dasignation</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="dasignation" id="dasignation" placeholder="Enter Dasignation Here" value="{{ $testimonial->dasignation }}">
							</div>
						</div>
						<div class="form-group row">
							<label for="video" class="col-sm-3 text-right control-label col-form-label">Video</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="video" id="video" placeholder="Enter video url Here" value="{{ $testimonial->video }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="model" class="col-sm-3 text-right control-label col-form-label">Model</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="model" id="model" placeholder="Enter Model Here" value="{{ $testimonial->model }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="model_id" class="col-sm-3 text-right control-label col-form-label">Model id</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="model_id" id="model_id" placeholder="Enter Model Id Here" value="{{ $testimonial->model_id }}" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label"> Course</label>
							<div class="col-sm-9">
								<select name="course_id" id="course_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Select Course</option>
									@foreach ($courses as $value)
									<option value="{{ $value->id }}" {{ ( $testimonial->course_id ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
									@endforeach
								</select>
							</div>
						</div>		
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label"> Placed At </label>
							<div class="col-sm-9">
								<select name="placed_at" id="placed_at" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Select Placed At</option>
									@foreach ($recruiters as $value)
									<option value="{{ $value->id }}" {{ ( $testimonial->placed_at ==  $value->id )? 'selected' : '' }} > {{ $value->name }} </option>
									@endforeach
								</select>
							</div>
						</div>					
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" {{ ( $testimonial->status ==  '1' )? 'selected' : '' }} > Publish</option>
									<option value="0" {{ ( $testimonial->status ==  '0' )? 'selected' : '' }}> Private </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tags" class="col-md-6 text-left control-label col-form-label">Featured Image</label>
							<div class="col-sm-6 text-center">
								<a href="#imageBox" class="image-profile open-popup-link">
									<img src="{{ (isset($testimonial->featured_image))?getSizedImage('',$testimonial->featured_image):'https://dummyimage.com/150x150?text=Add%20Image' }}" alt="">
									<input type="hidden" name="featured_image" id="featured_image" value="{{ $testimonial->featured_image }}" >	
								</a>	
								@if(isset($course->featured_image))
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
					<input type="hidden" name="testimonial_id" id="testimonial_id" value="{{ $testimonial->id }}" >
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

