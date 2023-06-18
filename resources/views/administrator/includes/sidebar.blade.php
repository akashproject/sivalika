<!-- Main Sidebar Container -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->

        <!-- ============================================================== -->

        <aside class="left-sidebar" data-sidebarbg="skin5">

            <!-- Sidebar scroll-->

            <div class="scroll-sidebar">

                <!-- Sidebar navigation-->

                <nav class="sidebar-nav">

                    <ul id="sidebarnav" class="p-t-30">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}" target="_blank" aria-expanded="false"><i class="mdi mdi-web"></i><span class="hide-menu">Visit Site</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu">Users </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="{{ url('users') }}" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> All Users </span></a></li>
                            </ul>
                        </li> 

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Pages </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/pages') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Pages </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-page') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Page </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Ad Pages </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/ad-pages') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Ad Pages </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-ad-page') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Ad Page </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('administrator/media') }}" aria-expanded="false"><i class="mdi mdi-folder-multiple-image"></i><span class="hide-menu">Media Library</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Courses </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/courses') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Courses </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-course') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Course </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/course-type') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Course type </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-home-map-marker"></i><span class="hide-menu">Centers </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/centers') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Centers </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-center') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Center </span></a></li>

                            </ul>

                        </li>	

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-home-map-marker"></i><span class="hide-menu"> Universities </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/universities') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Universities </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-university') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add University </span></a></li>

                            </ul>

                        </li>	
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-question-outline"></i><span class="hide-menu">Faqs</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/faqs') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Faqs </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-faq') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Faq </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-account-outline"></i><span class="hide-menu">Placements</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/placements') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Placements </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-placement') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Placement </span></a></li>

                            </ul>

                        </li>

                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-account-outline"></i><span class="hide-menu">Testimonials</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/testimonials') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Testimonials </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-testimonial') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Testimonial </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-account-outline"></i><span class="hide-menu">Recruiters</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/recruiters') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Recruiters </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-recruiter') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Recruiter </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-file-document-box"></i><span class="hide-menu">Blogs </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/blogs') }}" class="sidebar-link"><i class="mdi mdi-file-document-box"></i><span class="hide-menu"> All Blogs </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-blog') }}" class="sidebar-link"><i class="mdi mdi-file-document-box"></i><span class="hide-menu"> Add Blog </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/categories') }}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu"> Categories </span></a></li>
                                <li class="sidebar-item"><a href="{{ url('administrator/authors') }}" class="sidebar-link"><i class="mdi mdi-account"></i><span class="hide-menu"> Authors </span></a></li>

                                

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Jobs</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/jobs') }}" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> All Jobs </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-job') }}" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> Add Job </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/job-type') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Job type </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Brochures</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('administrator/brochures') }}" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> All Brochures </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('administrator/add-brochure') }}" class="sidebar-link"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu"> Add Brochure </span></a></li>
                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('administrator/tags') }}" aria-expanded="false"><i class="mdi mdi-tag"></i><span class="hide-menu">Tags</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('administrator/reviews') }}" aria-expanded="false"><i class="mdi mdi-star"></i><span class="hide-menu">Reviews</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('administrator/contacts') }}" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Contacts</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('administrator/settings') }}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings </span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('administrator/qrcode') }}" aria-expanded="false"><i class="mdi mdi-qrcode"></i><span class="hide-menu">QR Code</span></a>
                        </li>
                        
                    </ul>

                </nav>

                <!-- End Sidebar navigation -->

            </div>

            <!-- End Sidebar scroll-->

        </aside>

        <!-- ============================================================== -->

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

