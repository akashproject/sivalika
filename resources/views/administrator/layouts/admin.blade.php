<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Pankaj Kumar Jha">
    <!-- CSRF Token -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ICAjobgurentee') }}</title>
    <!-- Scripts -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.0.0/magnific-popup.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ url('assets/administrator/libs/flot/css/float-chart.css') }}" rel="stylesheet">
    <link href="{{ url('assets/administrator/extra-libs/multicheck/multicheck.css') }}" rel="stylesheet">
    <link href="{{ url('assets/administrator/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
    <link href="{{ url('assets/administrator/dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/administrator/dist/css/custom.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="">

    <!-- Preloader - style you can find in spinners.css -->
    
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    
    <!-- Main wrapper - style you can find in pages.scss -->
    
	<div id="main-wrapper">
        @if(auth()->check())
			@include('administrator.includes.navbar')
			@include('administrator.includes.sidebar')		
        @else
        <style>
            .page-wrapper {
                margin-left: 0 !important;
            }
        </style>
		@endif
		
		<div class="page-wrapper">
        @if(auth()->check())
			@include('administrator.includes.breadcrumbs')
        @endif
			@include('administrator.includes.message')
            <div class="container-fluid">
            <!-- Sales Cards  -->           
                <div class="row">
                @yield('content')
                </div>
		    </div>
            <!-- End PAge Content -->
            
		</div>
		@include('administrator.includes.footer')
	</div>
<!-- All Jquery -->
<script>
    let globalUrl = "{{ env("APP_URL") }}"
</script>
<script src="{{ url('assets/administrator/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ url('assets/administrator/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ url('assets/administrator/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ url('assets/administrator/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ url('assets/administrator/extra-libs/sparkline/sparkline.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/dropzone.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script src="{{ url('assets/administrator/dist/js/sidebarmenu.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/excanvas.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/jquery.flot.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/jquery.flot.time.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/jquery.flot.stack.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot/jquery.flot.crosshair.js') }}"></script>
<script src="{{ url('assets/administrator/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ url('assets/administrator/dist/js/waves.js') }}"></script>
<script src="{{ url('assets/administrator/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
<script src="{{ url('assets/administrator/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
<script src="{{ url('assets/administrator/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ url('assets/administrator/libs/quill/dist/quill.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
<script src="{{ url('assets/administrator/dist/js/custom.js') }}"></script>
<!--Wave Effects -->
<script>
    $('#zero_config').DataTable();
    tinymce.init({
        selector : ".editor",
        plugins: 'emoticons wordcount help code lists',
        menubar : true,
        toolbar: "undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck"
    });
</script>
<script>
    Dropzone.options.dropzonewidget = { 
        maxFilesize: 150, // 2 MB
        success: function(file, response){ // Dropzone upload response
            var html = '<a href="#imageBox" class="image-thumbnail open-popup-link" data-id="'+response.id+'"><img src="'+`${globalUrl}`+response.path+'/thumb_'+response.filename+'" alt="" style="width:100%"><span> '+response.name+' </span></a>';
            $(".image-thumbnail-container").prepend(html);
        }
    };
</script>
@yield('script')
</body>
</html>
