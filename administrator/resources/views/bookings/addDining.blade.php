@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-dining') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Assign Rooms </h4>
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
                        <a class="nav-link" data-toggle="tab" href="#rooms" role="tab"><span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down">Room Allotment</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#dining" role="tab"><span class="hidden-sm-up"></span>
                        <span class="hidden-xs-down">Add Dining</span></a>
                    </li>
                </ul>
				<div class="tab-content tabcontent-border">
					<div class="tab-pane active" id="rooms" role="tabpanel">
						<div class="p-20">
							<h4 class="card-title mt-3"> Dining Service </h4>
                            <div class="row py-3" style="background: #cccccc6b;">
                                @if($diningMeta != null)
                                <div class="col-md-3">
                                    <h5>Room</h5>
                                    @foreach($diningMeta['room'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <h5>Item</h5>
                                    @foreach($diningMeta['name'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <h5>Qty</h5>
                                    @foreach($diningMeta['qty'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                <div class="col-md-3">
                                    <h5>Price</h5>
                                    @foreach($diningMeta['price'] as $value)
                                        <p> {{$value}} </p>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                            <div class="row py-3" style="background: #cccccc6b;">
                                <div class="col-12 text-right" >
                                    <h3> Total Cost </h3>
                                    <p> {{array_sum($diningMeta['price'])}}/- </p>
                                </div>
                            </div>
							<div class="row order_row">
                                <label class="col-sm-1 text-right control-label col-form-label">Order 1 </label>
                                <div class="col-md-11">
                                    <div class="item_content">
                                        <div class="row mb-4">	
                                            <div class="col-sm-2 mb-2">
                                                <label for="room" class="">Select Room :</label>
                                                <select name="item[][room]" class="select2 form-control custom-select" style="width: 100%; height:36px;" required="">	
                                                    <option value=""> Select Room</option>
                                                    @foreach($hotelRooms as $value)
                                                    <option value="{{$value->hotel_room_no}}"> {{$value->hotel_room_no}}</option>
                                                    @endforeach
                                                </select>
                                            </div>										
                                            <div class="col-sm-3 mb-2">
                                                <label for="item[][name]" class="">Item Name :</label>
                                                <input type="text" class="form-control" name="item[][name]" value="" >
                                            </div>
                                            <div class="col-sm-1 mb-2">
                                                <label for="qty" class="">QTY :</label>
                                                <input type="number" class="form-control" name="item[][qty]" value="" min="0">
                                            </div>
                                            <div class="col-sm-2 mb-2">
                                                <label for="price" class="">Price:</label>
                                                <input type="number" class="form-control" name="item[][price]" value="" >
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

