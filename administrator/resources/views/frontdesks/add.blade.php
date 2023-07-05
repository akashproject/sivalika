@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-front-desk') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Front desk </h4>
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
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Hotel</label>
							<div class="col-sm-9">
								<select name="hotel_id" id="hotel_id" class="select2 form-control custom-select">	
									<option value="">Select Hotel</option>
									@foreach ($hotels as $hotel)
									<option value="{{  $hotel->id }}" > {{  $hotel->name }} </option>
									@endforeach
								<select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="name" id="name" placeholder="Enter Name Here" >
							</div>
						</div>
						<div class="form-group row">
							<label for="mobile" class="col-sm-3 text-right control-label col-form-label">Mobile Number</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile Number" >
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-3 text-right control-label col-form-label">Email Address</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="email" id="email" placeholder="Enter Email Address" >
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-3 text-right control-label col-form-label">Create Password</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="password" id="password" placeholder="Create Password" >
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%;">	
									<option value="1" > Activate </option>
									<option value="0" > Deactivate </option>
								<select>
							</div>
						</div>
					</div>
				</div>				
			</div>

			<div class="border-top">

				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="user_id" id="user_id" value="" >
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

