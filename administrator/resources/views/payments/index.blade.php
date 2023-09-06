@extends('layouts.admin')
@section('content')

<div class="col-12">
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
				@if($payments)
					
					<div class="card">
						<div class="card-body">
							<h5 class="card-title"> <a href="{{ url('/add-payment-history/'.$booking_id) }}" class="btn btn-primary"> Create Payment </a></h5>
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Amount</th>
											<th>Payment ID</th>
											<th>Order ID</th>
											<th>Payment Type</th>
											<th>Payment Status</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($payments as $value)
										<tr>
											<td>{{ $value->amount }}</td>													
											<td>{{ ($value->payment_id)?$value->payment_id:"N/A" }}</td>													
											<td>{{ ($value->order_id)?$value->order_id:"N/A" }}</td>													
											<td>{{ $value->payment_type }}</td>													
											<td>{{ $value->payment }}</td>													
										</tr>
										@endforeach							
									</tbody>
								</table>
							</div>
						</div>
					</div>
							
				@endif
			</div>
		</div>
	</div>
</div>                   
@endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection

