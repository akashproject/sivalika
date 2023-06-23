@if($rooms)
	@foreach ($rooms as $typeKey => $room)
	<input type="hidden" name="rooms[{{ $room->id }}]" >
	<div class="card" style="border: 1px solid #ccc;">
		<div class="card-body">
			<h4 class="card-title text-center">{{ $room->name }}</h4>
			<div class="room_type_{{$room->id}}" >
				<div class="row mt-2">
					<div class="col-sm-5">
						<span class="room-label">Adult</span>
						<span class="room-guest">
							<input class="form-control" name="rooms[{{$room->id}}][0][adult]" type="number" value="1">
						</span>
					</div>
					<div class="col-sm-5">
						<span class="room-label">Child</span>
						<span class="room-guest">
							<input class="form-control" type="number" name="rooms[{{$room->id}}][0][child]" value="0">
						</span>
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-danger btn remove-room"><i class="mdi mdi-delete"></i></button>
					</div>
				</div>
			</div>
			<div class="row mt-2 text-right">
				<button type="button" id="room_type_{{$room->id}}" class="btn btn-primary addNewRoom" data-id="{{$room->id}}"> Add Room </button>
			</div>
		</div>
	</div>
	@endforeach	
@endif