@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($reviews)

		<div class="card">

			<div class="card-body">

				<h5 class="card-title"> Datatable</h5>

				<div class="table-responsive">

					<table id="zero_config" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Summary</th>
								<th>Review</th>
								<th>Name</th>
								<th>Status</th>
								<th>Options</th>
							</tr>
						</thead>

						<tbody>

							@foreach ($reviews as $value)
							<tr>
								<td>{{ $value->title }}</td>													
								<td>{{ $value->review }}</td>													
								<td>{{ $value->reviewer_name }}</td>													
								<td>{{ ($value->status== 1)?"Active":"Deactivate" }}</td>													
								<td>									
									<a href="{{ url('view-review') }}/{{ $value->id }}" class="btn btn-primary btn-lg">Edit</a>
									<!-- <a href="{{ url('delete-review') }}/{{ $value->id }}" class="btn btn-danger btn-lg" onclick="return confirm('Are you sure?')"; >Delete </a> -->
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

