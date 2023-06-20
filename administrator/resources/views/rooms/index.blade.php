@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($rooms)

		<div class="card">

			<div class="card-body">

				<h5 class="card-title">
					<a href="{{ url('add-room/'.$hotel_id) }}" class="btn btn-primary"> Add New Room </a>
				</h5>

				<div class="table-responsive">

					<table id="zero_config" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Name</th>
								<th>Size</th>
								<th>Maximum Person</th>
								<th>Room Count</th>
								<th>Options</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($rooms as $value)
							<tr>												
								<td>{{ $value->name }}</td>													
								<td>{{ $value->size }}</td>													
								<td>{{ $value->person }}</td>													
								<td>{{ $value->room_count }}</td>													
								<td>
									<a href="{{ url('view-room') }}/{{ $value->id }}" class="btn btn-primary btn-lg">Edit</a>
									<a href="{{ url('delete-room') }}/{{ $value->id }}" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure?')"; >Delete </a>
								</td>
							</tr>
							@endforeach							
						</tbody>
					</table>
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

