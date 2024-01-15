@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-payment') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> New Payment </h4>
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
						<a class="nav-link" href="{{ url('add-guests/'.$booking_id)}}"><span class="hidden-sm-up"></span>
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
						<a class="nav-link active" href="{{ url('payment-history/'.$booking_id)}}"><span class="hidden-sm-up"></span>
						<span class="hidden-xs-down">Payment History</span></a>
					</li>
				</ul>
				<div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="checkin" role="tabpanel">
						<div class="p-20">
							<div class="row">
								<div class="col-md-7" >
									<div class="form-group row">
										<label for="amount" class="col-sm-3 text-right control-label col-form-label">Amount</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="payment_id" class="col-sm-3 text-right control-label col-form-label">Payment ID</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="payment_id" id="payment_id" placeholder="Enter Payment ID">
										</div>
									</div>
									<div class="form-group row">
										<label for="payment_type" class="col-sm-3 text-right control-label col-form-label">Payment Type</label>
										<div class="col-sm-8">
											<select name="payment_type" id="payment_type" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="" > Select Payment Type</option>
												<option value="Cash" > Cash</option>
												<option value="Upi" > Upi </option>
												<option value="Bank Transfer" > Bank Transfer </option>
												<option value="Card Mechine" > Card Mechine </option>
											<select>
										</div>
									</div>
									<div class="form-group row">
										<label for="state" class="col-sm-3 text-right control-label col-form-label">Payment Status</label>
										<div class="col-sm-8">
											<select name="payment" id="payment" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
												<option value="" > Select Payment Status</option>
												<option value="pending" > Pending</option>
												<option value="success" > Success </option>
											<select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="payment_id" id="payment_id" value="" >
					<input type="hidden" name="booking_id" id="booking_id" value="{{$booking_id}}" >
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

