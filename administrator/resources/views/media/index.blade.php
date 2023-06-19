@extends('layouts.admin')
@section('content')
<div class="card add-media" >
    <div class="card-body" >
        <h4 class="card-title"> Upload Media </h4>
        <form method="post" action="{{url('upload')}}" enctype="multipart/form-data" class="dropzone dz-clickable dz-started" id="dropzonewidget">
            @csrf
        </form>
    </div>
</div>

<div class="col-12">
	<div class="card">
        <div class="card-body">
            <div class="row filter-container" >
                <div class="col-md-6" >
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <select name="extension" id="extension" class="select2 form-control custom-select">	
                                <option value="1"> Images </option>
                                <option value="3"> Videos </option>
                                <option value="4" > Audios </option>
                                <option value="7"> Documents </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2" >
                </div>
                <div class="col-md-4">
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
                <div class="file-content text-center">      
                    <a href="#imageDetailBox" class="image-thumbnail open-popup-link">
                    @switch($value->type)
                        @case("application/pdf")
                        <img src="{{ url('assets/img/pdf.png') }}" alt="{{$value->alternative}}" style="width:100%">
                        @break
                        @default
                        <img src="{{ getSizedImage('thumb',$value->id) }}" alt="{{$value->alternative}}" style="width:100%">                       
                    @endswitch
                        <span > {{$value->filename}} </span>
                    </a>
                    <a target="_blank" href="{{ url('view-file') }}/{{ $value->id }}" style="display:block">Edit</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection