@extends('layouts.admin')

@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-contact') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> Edit contact </h4>
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
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Full Name</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $contact->name }} </span>
							</div>							
						</div>

						<div class="form-group row">
							<label for="slug" class="col-sm-3 text-right control-label col-form-label">Email Address</label>
							<div class="col-sm-9">
								<p> {{ $contact->email }} </p>
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Mobile no</label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $contact->mobile }} </span>
							</div>							
						</div>

						<div class="form-group row"> 
							<label for="name" class="col-sm-3 text-right control-label col-form-label"> Message </label>
							<div class="col-sm-9 text-left control-label col-form-label">
								<span> {{ $contact->message }} </span>
							</div>							
						</div>
					</div>
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

