@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-customer') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Add Customer </h4>
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
							<label for="dob" class="col-sm-3 text-right control-label col-form-label">Date of Birth</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="dob" id="datepicker dob" placeholder="Enter Date of Birth" >
							</div>
						</div>
						<div class="form-group row">
							<label for="gender" class="col-sm-3 text-right control-label col-form-label">Gender</label>
							<div class="col-sm-9">
								<select name="gender" id="gender" class="select2 form-control custom-select" style="width: 100%;">	
									<option value="">Select Gender</option>
									<option value="male" > Male </option>
									<option value="female" > Female </option>
									<option value="undisclosed" > Undisclosed </option>
								<select>
							</div>
						</div>
						<div class="form-group row">
							<label for="marital_status" class="col-sm-3 text-right control-label col-form-label">Marital Status</label>
							<div class="col-sm-9">
								<select name="marital_status" id="marital_status" class="select2 form-control custom-select" style="width: 100%;">	
									<option value="">Select Marital Status</option>
									<option value="married" > Married </option>
									<option value="unmarried" > Unmarried </option>
									<option value="undisclosed" > Undisclosed </option>
								<select>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="marital_status" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="marital_status" id="marital_status" class="select2 form-control custom-select" style="width: 100%;">	
									<option value="">Select Status</option>
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
					<input type="hidden" name="customer_id" id="customer_id" value="" >
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

