<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="{{ url('/admin') }}">
        <img src="{{asset('tai-chi.png')}}" class="mb-1" width="20">
        {{ config('app.name', 'Laravel') }}
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route("admin") }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-home"></i>
                        <p><span>{{__('Dashboard')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.jobs") }}" class="nav-link {{ request()->is('admin/jobs') || request()->is('admin/jobs/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clipboard-list"></i>
                        <p><span>{{__('Jobs')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.activities") }}" class="nav-link {{ request()->is('admin/activities') || request()->is('admin/activities/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-industry"></i>
                        <p><span>{{__('Activities')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.projects") }}" class="nav-link {{ request()->is('admin/projects') || request()->is('admin/projects/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-toolbox"></i>
                        <p><span>{{__('Projects')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.posts") }}" class="nav-link {{ request()->is('admin/posts') || request()->is('admin/posts/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-pen-fancy"></i>
                        <p><span>{{__('Posts')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.customers") }}" class="nav-link {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-users"></i>
                        <p><span>{{__('Customers')}}</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("admin.hourstacks") }}" class="nav-link {{ request()->is('admin/hourstacks') || request()->is('admin/hourstacks/*') ? 'active' : '' }}">
                        <i class="fa-fw fas fa-clock"></i>
                        <p><span>{{__('Hour stacks')}}</span></p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
