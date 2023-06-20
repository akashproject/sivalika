@extends('layouts.admin')
@section('content')
<div class="card add-media" >
    <div class="card-body" >
        <h4 class="card-title"> Upload Pincode </h4>
        <form method="post" action="{{url('upload-pincode')}}" enctype="multipart/form-data">
            @csrf
            @csrf
			<div class="card-body">
				@if ($errors->any())
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
				<div class="row">
					<div class="col-md-7" >
						<div class="form-group row">
							<label for="pincode" class="col-sm-3 text-right control-label col-form-label">Upload CSV</label>
							<div class="col-sm-9">
                                <span> Csv file should be only pincode field </span>
								<input type="file" class="form-control" name="pincode" id="pincode" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"  >
							</div>
						</div>

						
					</div>
					<div class="col-md-5">
						
					</div>

				</div>
				
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="center_id" id="center_id" value="{{ $center->id }}" >
					<input type="hidden" name="city_id" id="city_id" value="{{ $center->city_id }}" >
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