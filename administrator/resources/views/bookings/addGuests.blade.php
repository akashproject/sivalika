@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-guests') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Booking #{{ $booking_id }} <a href="{{ url('/preview-booking/'.$booking_id) }}" class="btn btn-success"> Preview </a></h4>
				<h4 class="card-title"> Add Booking </h4>
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
				<ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">				  
                    <a class="nav-link" href="{{ url('view-booking/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Checking Details</span></a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link active" data-toggle="tab" href="#guest" role="tab"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Guest Details</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('allocate-rooms/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Room Allotment</span></a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link" href="{{ url('add-dining/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Dining</span></a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link" href="{{ url('add-additonal-charge/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Additional Charge</span></a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link" href="{{ url('payment-history/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                      <span class="hidden-xs-down">Payment History</span></a>
                  </li>
                </ul>
				<div class="tab-content tabcontent-border">
					<input type="hidden" name="tab" value="guest" >
					<div class="tab-pane active" id="guest" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Guest Details </h4>
							@foreach($guests as $key => $guest)
							<div class="row guest_row">
								<label class="col-sm-1 text-right control-label col-form-label">Guest {{$key+1}}: </label>
								<div class="col-md-11">
									<div class="form-group row mb-4">											
										<div class="col-sm-2 mb-2">
											<label for="guest_name" class="">Enter Name :</label>
											<input type="text" class="form-control" name="guest[{{$key}}][name]" id="guest_name" value="{{$guest['name']}}" >
										</div>
										<div class="col-sm-2">
											<label for="dob" class="">Enter DOB :</label>
											<input type="date" class="form-control" name="guest[{{$key}}][dob]" id="dob" value="{{$guest['dob']}}" >
										</div>		
										<div class="col-sm-2">
											<label for="gander" class="">Select Gander :</label>
											<select name="guest[{{$key}}][gender]" id="gender" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="male" > Male </option>
												<option value="female" > Female </option>
												<option value="other" > Other </option>
											<select>
										</div>
										<div class="col-sm-2">
											<label for="address" class="">Enter Address :</label>
											<input type="text" class="form-control" name="guest[{{$key}}][address]" id="address" value="{{$guest['address']}}">
										</div>
										<div class="col-sm-2">
											<label for="city" class="">Enter City :</label>
											<input type="text" class="form-control" name="guest[{{$key}}][city]" id="city" value="{{$guest['city']}}">
										</div>		
										<div class="col-sm-2">
											<label for="state" class="">Enter State :</label>
											<select name="guest[{{$key}}][state]" id="state" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="" >Select State</option>
												@foreach(getStates() as $state)
												<option value="{{$state->name}}" > {{$state->name}} </option>
												@endforeach
											<select>
										</div>
										
										<div class="col-sm-2">
											<label for="pincode" class="">Enter Pincode :</label>
											<input type="text" class="form-control" name="guest[{{$key}}][pincode]" id="pincode" value="{{$guest['pincode']}}">
										</div>	
										<div class="col-sm-2">
											<label for="nationality" class="">Nationality :</label>
											<select name="guest[{{$key}}][nationality]" id="nationality" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="Indian" > Indian </option>
												<option value="Foreigner" > Foreigner </option>
											<select>
										</div>	
										<div class="col-sm-2">
											<label for="identity_type" class="">Select Identity :</label>
											<select name="guest[{{$key}}][identity_type]" id="identity_type" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="Aadhar Card" > Aadhar Card </option>
												<option value="Voter Card" > Voter Card </option>
												<option value="Driving Licence" > Driving Licence </option>
												<option value="Passport" > Passport </option>
											<select>
										</div>
										<div class="col-sm-2 text-center">
											<label for="identity" class="">Identity Number</label>
											<input type="text" class="form-control" name="guest[{{$key}}][identity]" id="identity" placeholder="Identity Number" value="{{$guest['identity']}}">
										</div>

										@if(isset($guest['identity_image']) && $guest['identity_image'] != '')
										<div class="col-sm-2">	
											<label for="identity" class="">Identity Image</label>
											<input type="hidden" class="form-control" name="guest[{{$key}}][identity_image]" id="identity_image" placeholder="Identity Image" value="{{$guest['identity_image']}}">
											<div class="image_preview" >
												<img src="{{ url($guest['identity_image'])}}" style="width:100%">
											</div>
											<a href="javascript:void(0)" class="updateImageType" > Update </a>
										</div>	
										@else
										<div class="col-sm-2">
											<label for="identity" class="">Identity Image</label>
											<input type="file" class="form-control" name="guest[{{$key}}][identity_image]" id="identity_image" placeholder="Identity Image">
										</div>
										@endif	

										@if(isset($guest['profile_image']) && $guest['profile_image'] != '')
										<div class="col-sm-2">	
											<label for="identity" class="">Customer Photo</label>
											<input type="hidden" class="form-control" name="guest[{{$key}}][profile_image]" id="identity_image" placeholder="Profile Image" value="{{$guest['profile_image']}}">
											<div class="image_preview" >
												<img src="{{ url($guest['profile_image'])}}" style="width:100%">
											</div>
											<a href="javascript:void(0)" class="updateImageType" > Update </a>
										</div>	
										@else
										<div class="col-sm-2">
											<label for="identity" class="">Customer Photo</label>
											<input type="file" class="form-control" name="guest[{{$key}}][profile_image]" id="profile_image" placeholder="Customer Photo">
											
										</div>
										@endif		
									</div>
								</div>
							</div>
							@endforeach
										
						</div>
					</div>
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="bookingId" id="bookingId" value="{{$booking_id}}" >
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

