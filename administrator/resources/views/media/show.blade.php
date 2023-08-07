@extends('layouts.admin')
@section('content')
<div class="col-12">
	<div class="card">
		<form class="form-horizontal" method="post" action="{{ url('save-file') }}" enctype="multipart/form-data">
			@csrf
			<div class="card-body">
				<h4 class="card-title"> General Options </h4>
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
					<div class="col-md-8" >
						<div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">File Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="name" id="name" placeholder="File Name Here"  value="{{ $file->name }}" >
							</div>
						</div>
                        <div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label"></label>
							<div class="col-sm-9">
                                <img src="{{ getSizedImage('',$file->id) }}" alt="{{$file->alternative}}" style="width:100%">
							</div>
						</div>
                        <div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Alternative Text</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="alternative" id="alternative" placeholder="Alternative Text Here"  value="{{ $file->alternative }}" >
							</div>
						</div>
                        <div class="form-group row">
							<label for="name" class="col-sm-3 text-right control-label col-form-label">Caption</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="caption" id="caption" placeholder="Caption Here"  value="{{ $file->caption }}" >
							</div>
						</div>
						<div class="form-group row">
							<label for="description" class="col-sm-3 text-right control-label col-form-label">Description</label>
							<div class="col-sm-9">
								<textarea class="form-control editor" name="description" id="description" placeholder="Enter description Here" >{{ $file->description }}</textarea>
							</div>
						</div>
					</div>
					<div class="col-md-4">
                        <div class="form-group row">
							<label for="created_at" class="col-sm-4 text-left control-label col-form-label">Created At</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                {{ $file->created_at }}
							</div>
						</div>
						<div class="form-group row">
							<label for="path" class="col-sm-4 text-left control-label col-form-label">File Path</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                <input type="text" class="form-control" id="path" placeholder="File Path Here"  value="{{ $file->path }}" readonly >
							</div>
						</div>
						<div class="form-group row">
							<label for="name" class="col-sm-4 text-left control-label col-form-label">File name</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                {{ $file->name }}
							</div>
						</div>
                        <div class="form-group row">
							<label for="type" class="col-sm-4 text-left control-label col-form-label">File Type</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                {{ $file->type }}
							</div>
						</div>
                        <div class="form-group row">
							<label for="size" class="col-sm-4 text-left control-label col-form-label">File Size</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                {{ $file->size }}
							</div>
						</div>
                        <div class="form-group row">
							<label for="size" class="col-sm-4 text-left control-label col-form-label">Dimensions</label>
							<div class="col-sm-8 text-left control-label col-form-label">
                                {{ $file->dimension }}
							</div>
						</div>
                        <div class="form-group row">
                            <div class="col-sm-6 text-left control-label col-form-label">
                                <a href="{{ url($file->path) }}/{{$file->filename}}" class="btn btn-primary text-white" download>Download</a>
							</div>
                            <div class="col-sm-6 text-left control-label col-form-label">
                                <a href="{{ url('delete-file') }}/{{ $file->id }}" class="btn btn-danger" onclick="return confirm('Are you sure?')"; >Delete </a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="border-top">
				<div class="card-body">
					<button type="submit" class="btn btn-primary">Submit</button>
					<input type="hidden" name="file_id" id="file_id" value="{{ $file->id }}" >
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