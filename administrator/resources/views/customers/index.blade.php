@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($customers)
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="zero_config" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Mobile</th>
								<th>Email</th>
								<th>Options</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($customers as $value)
							<tr>												
								<td>{{ $value->name }}</td>													
								<td>{{ $value->mobile }}</td>													
								<td>{{ $value->email }}</td>
								<td>
									<a href="{{ url('view-customer') }}/{{ $value->id }}" class="btn btn-primary btn-sm">Edit</a>
									<a href="{{ url('delete-customer') }}/{{ $value->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"; >Delete </a>
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

