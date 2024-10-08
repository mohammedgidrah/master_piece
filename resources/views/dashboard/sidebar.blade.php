<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href={{ route('status') }} class="logo">
                <img src="{{ asset('assets/img/masterpeace_logo__1_-removebg-preview.png') }}" alt="navbar brand"
                    class="navbar-brand" height="150" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar ">
                    <i class="gg-menu-right m-3"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler ">
                    <i class="gg-menu-left m-3"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt m-3"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">dashboard</h4>
                </li>
                <li class="nav-item active">
                    <a href={{ route('status') }} class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
                    </a>

                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                {{-- users --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                        <i class="fa-solid fa-users"></i>
                        <p>users</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="tables">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <span class="sub-item">All user</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.create') }}">
                                    <span class="sub-item">create user</span>
                                </a>
                            </li>
                        </ul> 
                    </div>
                </li>

 




            </ul>
        </div>
    </div>
</div>
