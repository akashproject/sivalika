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

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-face"></i><span class="hide-menu"> Customers </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
								<li class="sidebar-item"><a href="{{ url('users') }}" class="sidebar-link"><i class="mdi mdi-emoticon"></i><span class="hide-menu"> All Users </span></a></li>
                            </ul>
                        </li> 

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Hotels</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('hotels') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Hotels </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('add-hotel') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Hotel </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Pages </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('pages') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Pages </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('add-page') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Page </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-book-multiple-variant"></i><span class="hide-menu">Ad Pages </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('ad-pages') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Ad Pages </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('add-ad-page') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Ad Page </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('media') }}" aria-expanded="false"><i class="mdi mdi-folder-multiple-image"></i><span class="hide-menu">Media Library</span></a></li>
                        
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-comment-question-outline"></i><span class="hide-menu">Faqs</span></a>

                            <ul aria-expanded="false" class="collapse  first-level">

								<li class="sidebar-item"><a href="{{ url('faqs') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> All Faqs </span></a></li>

                                <li class="sidebar-item"><a href="{{ url('add-faq') }}" class="sidebar-link"><i class="mdi mdi-border-inside"></i><span class="hide-menu"> Add Faq </span></a></li>

                            </ul>

                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('reviews') }}" aria-expanded="false"><i class="mdi mdi-star"></i><span class="hide-menu">Reviews</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('contacts') }}" aria-expanded="false"><i class="mdi mdi-email"></i><span class="hide-menu">Contacts</span></a></li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark" href="{{ url('settings') }}" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings </span></a>
                        </li>

                    </ul>

                </nav>

                <!-- End Sidebar navigation -->

            </div>

            <!-- End Sidebar scroll-->

        </aside>

        <!-- ============================================================== -->

        <!-- End Left Sidebar - style you can find in sidebar.scss  -->

