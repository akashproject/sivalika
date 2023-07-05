@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($rooms)
		<div class="row" >
			<div class="col-md-9">	
				<div class="card">
					<div class="card-body">
						<div class="row" >
						@foreach ($rooms as $value)
							<div class="col-md-2" style="height:80px">	
								@php
									$statusColor = ['active'=>'#52b532','blocked'=>'#bcc5b9','not-cleaned'=>'#b7c928','reserved'=>'#f34f6d']
								@endphp
								<div class="hotelroom" style="background:{{ $statusColor[$value->status] }}">	
									<a class="room-no" target="_blank" href="{{ url('/view-hotel-room/'.$value->id) }}">{{ $value->hotel_room_no }}</a>
								</div>
							</div>
							@endforeach		
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-3">	
				<div class="card">
					<div class="card-body">
						<p> <span class="color-code" style="background:#52b532"> </span> Active </p>
						<p> <span class="color-code" style="background:#b7c928"> </span>Not Cleaned </p>
						<p> <span class="color-code" style="background:#bcc5b9"> </span>Blocked </p>
						<p> <span class="color-code" style="background:#f34f6d"> </span> Reserved </p>
					</div>
				</div>
			</div>
		</div>

	@endif

</div>                   

@endsection

@section('script')

<!-- ============================================================== -->

<!-- CHARTS -->

@endsection

