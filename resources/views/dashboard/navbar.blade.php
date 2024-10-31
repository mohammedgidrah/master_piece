<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('status') }}" class="logo">
                <img src="{{ asset('assets/img/masterpeace_logo__1_-removebg-preview.png') }}" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar"><i class="gg-menu-right"></i></button>
                <button class="btn btn-toggle sidenav-toggler"><i class="gg-menu-left"></i></button>
            </div>
            <button class="topbar-toggler more"><i class="gg-more-vertical-alt"></i></button>
        </div>
        <!-- End Logo Header -->
    </div>

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <!-- Notifications -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        {{-- <span class="notification">{{ $notifications->count() }}</span> --}}
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            {{-- <div class="dropdown-title">You have {{ $notifications->count() }} new notifications</div> --}}
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    {{-- @foreach($notifications as $notification) --}}
                                        <a href="#">
                                            <div class="notif-icon notif-primary"><i class="fa fa-comment"></i></div>
                                            <div class="notif-content">
                                                {{-- <span class="block">{{ json_decode($notification->data)->message ?? 'No message' }}</span> --}}
                                                {{-- <span class="time">{{ $notification->created_at->diffForHumans() }}</span> --}}
                                            </div>
                                        </a>
                                    {{-- @endforeach --}}
                                </div>
                            </div>
                        </li>
                        <li><a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i></a></li>
                    </ul>
                </li>
                <!-- User Profile -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}" alt="User Avatar" class="avatar-img rounded-circle" />
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}" alt="User Avatar" class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                        <a href="{{ route('adminprofile') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">My Balance</a>
                                <a class="dropdown-item" href="#">Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>
