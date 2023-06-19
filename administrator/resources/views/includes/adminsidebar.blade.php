@if(Auth::user()->hasRole('Administrator'))

{{-- <li class="nav-item">

    <a href="{{ route('dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard')) ? 'active' : '' }}">

        <i class="nav-icon fas fa-tachometer-alt"></i>

        <p>Dashboard</p>

    </a>

</li> --}}

<li class="nav-item">

    <a href="{{ route('admin.users.all') }}" class="nav-link">

        <i class="nav-icon fas fas fa-user"></i>

        <p>Users</p>

    </a>

    <a href="{{ route('admin.questions.all') }}" class="nav-link {{ (request()->is('admin/questions/all')) ? 'active' : '' }}">

        <i class="nav-icon fas fas fa-user"></i>

        <p>Questions</p>

    </a>

    <a href="{{ route('admin.manage-home-page.edit') }}" class="nav-link {{ (request()->is('admin/manage-home-page/edit')) ? 'active' : '' }}">

        <i class="nav-icon fas fas fa-file"></i>

        <p>Home Page</p>

    </a>

    <a href="{{ route('admin.about.all') }}" class="nav-link {{ (request()->is('admin/about/all')) ? 'active' : '' }}">

        <i class="nav-icon fas fas fa-file"></i>

        <p>About Page</p>

    </a>

    <a href="{{ route('admin.resource.all') }}" class="nav-link {{ (request()->is('admin/resource/all')) ? 'active' : '' }}">

            <i class="nav-icon fas fas fa-file"></i>

            <p>Resource </p>

        </a>



        <a href="{{ route('admin.partner.all') }}" class="nav-link {{ (request()->is('admin/partner/all')) ? 'active' : '' }}">

                <i class="nav-icon fas fas fa-users"></i>

                <p>Partners</p>

            </a>

            <a href="{{ route('admin.employeer.all') }}" class="nav-link {{ (request()->is('admin/employer/all')) ? 'active' : '' }}">

                    <i class="nav-icon fas fas fa-users"></i>

                    <p>Employers</p>

                </a>

        <a href="{{ route('admin.contact.edit') }}" class="nav-link {{ (request()->is('admin/contact/edit')) ? 'active' : '' }}">

            <i class="nav-icon fas fas fa-file"></i>

            <p>Contact Us Page </p>

        </a>

        <a href="{{ route('admin.privacy.edit') }}" class="nav-link {{ (request()->is('admin/privacy/edit')) ? 'active' : '' }}">

            <i class="nav-icon fas fas fa-file"></i>

            <p>Privacy Page </p>

        </a>

        <a href="{{ route('admin.social.edit') }}" class="nav-link {{ (request()->is('admin/social/edit')) ? 'active' : '' }}">

            <i class="nav-icon fas fas fa-file"></i>

            <p>Manage Social Links </p>

        </a>

</li>

@endif

