@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-additonal-charge') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
            <h4 class="card-title"> Booking #{{ $booking_id }} <a href="{{ url('/preview-booking/'.$booking_id) }}" class="btn btn-success"> Preview </a></h4>
                <h4 class="card-title mt-3"> Additional Service </h4>
				@if($errors->any())
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
                        <a class="nav-link active" href="{{ url('add-additonal-charge/'.$booking_id)}}"><span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down">Additional Charge</span></a>
                    </li>
                </ul>
				<div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="rooms" role="tabpanel">
						<div class="p-20 mt-5">
                            @if($additionalChargeMeta != null)
                            <div class="row py-3" style="">
                                <div class="col-md-3">
                                    <h5>Room</h5>
                                    @foreach($additionalChargeMeta['room'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <h5>Item</h5>
                                    @foreach($additionalChargeMeta['service'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <h5>Price</h5>
                                    @foreach($additionalChargeMeta['price'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row py-3" style="">
                                <div class="col-12 text-right" >
                                    <h3> Total Cost </h3>
                                    <p> {{array_sum($additionalChargeMeta['price'])}}/- </p>
                                </div>
                            </div>
                            @endif
							<div class="row order_row">
                                <label class="col-sm-1 text-right control-label col-form-label">Order 1 </label>
                                <div class="col-md-11">
                                    <div class="item_content">
                                        <div class="row mb-4">	
                                            <div class="col-sm-2 mb-2">
                                                <label for="room" class="">Select Room :</label>
                                                <select name="item[room][]" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="">	
                                                    <option value=""> Select Room</option>
                                                    @foreach($hotelRooms as $value)
                                                    <option value="{{$value->hotel_room_no}}"> {{$value->hotel_room_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>										
                                            <div class="col-sm-3 mb-2">
                                                <label for="item[service][]" class="">Service:</label>
                                                <input type="text" class="form-control" name="item[service][]" value="" >
                                            </div>
                                            <div class="col-sm-2 mb-2">
                                                <label for="price" class="">Price:</label>
                                                <input type="number" class="form-control" name="item[price][]" value="" >
                                            </div>
                                            <div class="col-sm-1 mb-2">
                                                <label for="item_name" class=""></label>
                                                <button type="button" class="mt-4 btn btn-danger btn removeDiningItem">
                                                    <i class="mdi mdi-delete"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
						    </div>
                            <div class="row">
                                <div class="col-sm-1"></div>
                                <div class="col-sm-11">
                                    <button type="button" id="" class="btn btn-primary addNewItem">
                                        Add Item 
                                    </button>
                                </div>
						    </div>
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

