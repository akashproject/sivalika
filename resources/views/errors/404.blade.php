@extends('layouts.main')

    @section('content')
    <!-- Start of breadcrumb section
		============================================= -->
	<section id="breadcrumb" class="inner-banner relative-position backgroud-style">
		<div class="container">
			<div class="row text-center">
				<div style="margin: auto;" >
                    <h1 style="font-size: 10pc;color: #444343;"> 404 </h1>
                    <h3 style="color: #444343;"> Oops, Page Not Found </h3>
                    <h6 style="color: #444343;width: 59%;text-align: center;margin: 2rem auto;font-size: 15px;"> We are very sorry for the inconvenience. It looks like you're trying to access a page that has been deleted or never even existed. </h6>
                    <div class="more-btn text-center">
                        <div class="course-type-list">	
                            <a class="btn-filled" href="{{url('/courses')}}" > Back to Courses</a>
                        </div>													
                    </div>
                </div>
			</div>
		</div>
	</section>
	<!-- End of breadcrumb section
		============================================= -->

    @endsection
@section('script')
<!-- ============================================================== -->
<!-- CHARTS -->
@endsection