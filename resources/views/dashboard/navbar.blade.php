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
                <!-- Search Icon -->
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>
                <!-- Notifications -->
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="notification">4</span>
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li><div class="dropdown-title">You have 4 new notifications</div></li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    <a href="#">
                                        <div class="notif-icon notif-primary"><i class="fa fa-user-plus"></i></div>
                                        <div class="notif-content"><span class="block">New user registered</span><span class="time">5 minutes ago</span></div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-success"><i class="fa fa-comment"></i></div>
                                        <div class="notif-content"><span class="block">Rahmad commented on Admin</span><span class="time">12 minutes ago</span></div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-img"><img src="{{ asset('assets/img/profile2.jpg') }}" alt="Img Profile" /></div>
                                        <div class="notif-content"><span class="block">Reza sent messages to you</span><span class="time">12 minutes ago</span></div>
                                    </a>
                                    <a href="#">
                                        <div class="notif-icon notif-danger"><i class="fa fa-heart"></i></div>
                                        <div class="notif-content"><span class="block">Farrah liked Admin</span><span class="time">17 minutes ago</span></div>
                                    </a>
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
                            @if (Auth::check() && Auth::user()->image)
                                <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="User Avatar" class="avatar-img rounded-circle" />
                            @else
                                <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Default Avatar" class="avatar-img rounded-circle" />
                            @endif
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
                                        @if (Auth::check() && Auth::user()->image)
                                            <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="User Avatar" class="avatar-img rounded-circle" />
                                        @else
                                            <img src="{{ asset('assets/img/default-avatar.png') }}" alt="Default Avatar" class="avatar-img rounded-circle" />
                                        @endif
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

<script>
    async function fetchNotifications() {
        try {
            console.log("Fetching notifications...");
            const response = await fetch("{{ route('notifications') }}");
            if (!response.ok) throw new Error('Network response was not ok');
            const notifications = await response.json();

            console.log(notifications); // Log notifications to check their format

            let notificationList = document.querySelector('.notif-center');
            notificationList.innerHTML = ''; // Clear existing notifications

            notifications.forEach(notification => {
                const notifItem = `
                    <a href="#">
                        <div class="notif-icon notif-primary"><i class="fa fa-comment"></i></div>
                        <div class="notif-content">
                            <span class="block">${JSON.parse(notification.data).message}</span>
                            <span class="time">${new Date(notification.created_at).toLocaleTimeString()}</span>
                        </div>
                    </a>
                `;
                notificationList.insertAdjacentHTML('beforeend', notifItem);
            });
            document.querySelector('.notification').textContent = notifications.length; // Update notification count
        } catch (error) {
            console.error("Error fetching notifications:", error);
        }
    }

    // Call the function on page load or periodically to refresh notifications
    document.addEventListener('DOMContentLoaded', fetchNotifications);
    setInterval(fetchNotifications, 60000); // Refresh every minute
</script>
