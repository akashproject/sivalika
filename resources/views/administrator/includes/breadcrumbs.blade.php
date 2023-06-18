
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Dashboard</h4>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						@php
							$link = ""
						@endphp
						@for($i = 1; $i <= count(Request::segments()); $i++)
							@if($i < count(Request::segments()) & $i > 0)
								@php
									$link .= "/dashboard/" . Request::segment($i);
								@endphp
								<li class="breadcrumb-item">
									<a href="{{route('dashboard')}}">{{ ucwords(str_replace('-',' ',Request::segment($i))) }}</a>
								</li>
							@else
								<li class="breadcrumb-item active">
									{{ ucwords(str_replace('-',' ',Request::segment($i))) }}
								</li>
							@endif
						@endfor
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== 
/* <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            @if(Request::segment(count(Request::segments())) != 'index') <h1 class="m-0 text-dark">{{ is_numeric(ucwords(str_replace('-',' ',Request::segment(count(Request::segments()))))) ? '' : ucwords(str_replace('-',' ',Request::segment(count(Request::segments())))) }}</h1> @endif
            
        </div>
        <div class="col-sm-6">
            
        </div>
    </div>
</div> */-->
