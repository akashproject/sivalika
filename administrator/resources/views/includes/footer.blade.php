
<div id="imageBox" class="white-popup mfp-hide">
	<div class="row">
		<div class="card add-media" >
			<div class="card-body" >
				<h4 class="card-title"> Upload Media </h4>
				<form method="post" action="{{url('upload')}}" enctype="multipart/form-data" class="dropzone dz-clickable dz-started" id="dropzonewidget">
					@csrf
				</form>
			</div>
		</div>
	</div>
	<div class="row" >
		<div class="col-md-9" >
			<div class="row filter-container" >
				<div class="col-md-6" >
					<div class="form-group row">
						<div class="col-sm-6">
							<select name="extension" id="extension" class="select2 form-control custom-select" style="width: 100%; height:36px;">	
								<option value="1"> Images </option>
								<option value="3"> Videos </option>
								<option value="4" > Audios </option>
								<option value="7"> Documents </option>
							</select>
						</div>
						<div class="col-sm-6">
							<button class="btn btn-primary text-white open-popup-link">Bulk Select</button>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group row">
						<label for="name" class="col-sm-3 text-right control-label col-form-label">Search </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="search" id="searchMedia" placeholder="Search" >
						</div>
					</div>
				</div>
			</div>
			<div class="row image-thumbnail-container">
				@foreach ($media as $value)        
					<div class="image-thumbnail" data-id="{{$value->id}}">
						@switch($value->type)
							@case("application/pdf")
							<img src="{{ url('assets/img/pdf.png') }}" alt="{{$value->alternative}}" style="width:100%">
							@break
							@default
							<img src="{{ getSizedImage('thumb',$value->id) }}" alt="{{$value->alternative}}" style="width:100%">                       
						@endswitch
						<span > {{$value->filename}} </span>
					</div>
				@endforeach
			</div>
		</div>
		<div class="col-md-3" >
			<div class="view-media-container" >
				<h5> Expand Details </h5>
				<form class="form-horizontal" method="post" action="{{ url('save-media-detail') }}" enctype="multipart/form-data"> @csrf
					<div class="row">
						<div class="col-md-12" >
							<div class="form-group row">
								<label for="alternative" class="col-sm-12 text-left control-label col-form-label">Title</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="title" id="title" placeholder="Title Here" >
								</div>
							</div>
							<div class="form-group row">
								<label for="alternative" class="col-sm-12 text-left control-label col-form-label">Alt Text</label>
								<div class="col-sm-12">
									<textarea class="form-control" name="alternative" id="alternative" placeholder="Enter Alt Text" ></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="description" class="col-sm-12 text-left control-label col-form-label">Description</label>
								<div class="col-sm-12">
									<textarea class="form-control" name="description" id="description" placeholder="Enter Description" ></textarea>
								</div>
							</div>
							<div class="form-group row">
								<label for="utm_campaign" class="col-sm-12 text-left control-label col-form-label">File Url</label>
								<div class="col-sm-12">
									<input type="text" class="form-control" name="" id="" placeholder="" readonly>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 text-right">
			<div class="form-group">
				<button type="button" class="btn btn-primary" onclick="setMedia()"> Upload Media </button>
			</div>
		</div>
	</div>
</div>

<div id="imageDetailBox" class="white-popup mfp-hide">
	<div class="card">
        <div class="card-body">
			<div class="row" >
				<div class="col-md-9" >
					<div class="row filter-container" >
					</div>
				</div>
				<div class="col-md-3" >
					<div class="view-media-container" >
						<h5> Expand Details </h5>
						<form class="form-horizontal" method="post" action="{{ url('save-media-detail') }}" enctype="multipart/form-data"> @csrf
							<div class="row">
								<div class="col-md-12" >
									<div class="form-group row">
										<label for="alternative" class="col-sm-12 text-left control-label col-form-label">Title</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" name="title" id="title" placeholder="Title Here" >
										</div>
									</div>
									<div class="form-group row">
										<label for="alternative" class="col-sm-12 text-left control-label col-form-label">Alt Text</label>
										<div class="col-sm-12">
											<textarea class="form-control" name="alternative" id="alternative" placeholder="Enter Alt Text" ></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="description" class="col-sm-12 text-left control-label col-form-label">Description</label>
										<div class="col-sm-12">
											<textarea class="form-control" name="description" id="description" placeholder="Enter Description" ></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="utm_campaign" class="col-sm-12 text-left control-label col-form-label">File Url</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" name="" id="" placeholder="" readonly>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<footer class="footer text-center">
	<strong>Copyright &copy; {{ date('Y') }}
        <a href="{{ env('APP_URL') }}" target="_blank">Sivalika Group </a></strong>
	All Rights Reserved by <a href="https://scriptcrown.com">Sivalika Group</a>.
</footer>