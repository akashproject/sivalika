@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-hotel') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Hotel </h4>
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
							<label for="slug" class="col-sm-3 text-right control-label col-form-label">Slug</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="slug" id="slug" placeholder="Slug Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="excerpt" class="col-sm-3 text-right control-label col-form-label">Excerpt</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="excerpt"  id="mceEditor" placeholder="Enter excerpt Here" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="description"  id="mceEditor" placeholder="Enter description Here" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="address" class="col-sm-3 text-right control-label col-form-label">Address</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="address" id="address" placeholder="Enter Address" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="gmap" class="col-sm-3 text-right control-label col-form-label">Gmap Location</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="gmap" id="gmap" placeholder="Enter Gmap Location Code" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="lat" class="col-sm-3 text-right control-label col-form-label">Lattitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lat" id="lat" placeholder="Enter Name Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="lng" class="col-sm-3 text-right control-label col-form-label">Longitude</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="lng" id="lng" placeholder="Slug Here" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Select State</label>
							<div class="col-sm-9">
								<select name="state_id" id="state_id" class="select2 form-control custom-select" style="width: 100%; height:36px;" onChange="getCitiesByStateId(this);">	
									<option value="">Select State</option>
									@foreach ($states as $value)
									<option value="{{ $value->id }}" > {{ $value->name }} </option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Select City</label>
							<div class="col-sm-9">
								<select name="city_id" id="city_id" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Select City</option>
								</select>
							</div>
						</div>		
						
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
				<h4 class="card-title"> Search Engine Options </h4>
				<div class="row">
					<div class="col-md-7" >
						<div class="form-group row">
							<label for="title" class="col-sm-3 text-right control-label col-form-label">Title</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="title" id="title" placeholder="Title Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="meta_description" class="col-sm-3 text-right control-label col-form-label">Meta Description</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="meta_description" id="meta_description" placeholder="Enter Meta Description Here" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="schema" class="col-sm-3 text-right control-label col-form-label">Schema Code</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="schema" id="schema" placeholder="Enter Schema Code" ></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="utm_campaign" class="col-sm-3 text-right control-label col-form-label">Campaign</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_campaign" id="utm_campaign" placeholder="Enter Utm Campaign Here" >
							</div>
						</div>

						<div class="form-group row">
							<label for="utm_source" class="col-sm-3 text-right control-label col-form-label">Source</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="utm_source" id="utm_source" placeholder="Enter Utm Source Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="robots" class="col-sm-3 text-right control-label col-form-label">Robots Content</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="robots" id="robots" placeholder="Enter Hotel Pincode Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="canonical" class="col-sm-3 text-right control-label col-form-label">Cronical Url</label>
							<div class="col-sm-9">
							<input type="text" class="form-control" name="canonical" id="canonical" placeholder="Enter Canonical Url Here" >
							</div>
						</div>
					</div>
					<div class="col-md-5" >

					</div>
				</div>
			</div>

			<div class="border-top">

				<div class="card-body">

					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="hotel_id" id="hotel_id" value="" >
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

