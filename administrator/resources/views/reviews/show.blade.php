@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-review') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Edit review </h4>
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
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Summary</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $review->title }} </span>
							</div>							
						</div>

						<div class="form-group row">
							<label for="slug" class="col-sm-3 text-right control-label col-form-label">Review</label>
							<div class="col-sm-9">
								<p> {{ $review->review }} </p>
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Name</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $review->reviewer_name }} </span>
							</div>							
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Email</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $review->reviewer_email }} </span>
							</div>							
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Type</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $review->model }} </span>
							</div>							
						</div>
						
					</div>
					<div class="col-md-5">
						<div class="form-group row">
							<label for="state" class="col-sm-3 text-right control-label col-form-label">Status</label>
							<div class="col-sm-9">
								<select name="status" id="status" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
									<option value="">Update Status</option>
									<option value="1" {{ ( $review->status ==  '1' )? 'selected' : '' }} > Active</option>
									<option value="0" {{ ( $review->status ==  '0' )? 'selected' : '' }}> Deactive </option>
								<select>
							</div>
						</div>
					</div>

				</div>				
			</div>

			<div class="border-top">

				<div class="card-body">

					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="review_id" id="review_id" value="{{ $review->id }}" >
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

