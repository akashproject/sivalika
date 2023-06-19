@extends('layouts.admin')



@section('content')

<div class="col-12">

	@if($contacts)

		<div class="card">

			<div class="card-body">

				<h5 class="card-title"> Datatable</h5>

				<div class="table-responsive">

					<table id="zero_config" class="table table-striped table-bordered">

						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Mobile</th>
								<th>Options</th>
							</tr>
						</thead>

						<tbody>

							@foreach ($contacts as $value)
							<tr>
								<td>{{ $value->name }}</td>													
								<td>{{ $value->email }}</td>													
								<td>{{ $value->mobile }}</td>													
								<td>									
									<a href="{{ url('view-contact') }}/{{ $value->id }}" class="btn btn-success btn-lg">View</a>
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

