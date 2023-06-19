@extends('layouts.admin')
@section('content')
<div class="col-12">
	@if($testimonials)
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"> Datatable</h5>
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Comment</th>
								<th>Dasignation</th>
								<th>Status</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($testimonials as $value)
							<tr>
								<td>{{ $value->name }}</td>													
								<td>{!! $value->comment !!}</td>													
								<td>{{ $value->dasignation }}</td>													
								<td>{{ ($value->status== 1)?"Active":"Deactivate" }}</td>													
								<td>									
									<a href="{{ url('view-testimonial') }}/{{ $value->id }}" class="btn btn-primary btn-lg">Edit</a>
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

