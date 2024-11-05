<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('status') }}" class="logo">
                <img src="{{ asset('assets/img/masterpeace_logo__1_-removebg-preview.png') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
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
                    <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        @if ($notifications->where('type', 'New Order')->count() > 0)
                            <span class="notification">{{ $notifications->where('type', 'New Order')->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                {{ $notifications->where('type', 'New Order')->count() > 0 ? "You have {$notifications->where('type', 'New Order')->count()} new orders" : 'There are no new orders' }}
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @forelse($notifications as $notification)
                                    @php
                                        $notificationData = json_decode($notification->data);
                                        $orderId = $notificationData->order_id ?? null; // Ensure order_id is retrieved
                                    @endphp
                                    @if ($orderId)
                                        <a href="{{ route('orders.handle', ['id' => $notification->id, 'order_id' => $orderId]) }}">
                                            <div class="notif-content">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs me-2">
                                                        <img src="{{ $notification->user->image ? asset('storage/' . $notification->user->image) : asset('assets/img/default-avatar.png') }}"
                                                            alt="User Image" class="avatar-img rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <span class="block">{{ $notificationData->message ?? 'No message' }}</span>
                                                        <span class="block">User: {{ $notificationData->user_name ?? 'Unknown User' }}</span>
                                                        <span class="block">Email: {{ $notificationData->user_email ?? 'No Email' }}</span>
                                                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                                <div class="dropdown-divider"></div>
                                            </div>
                                        </a>
                                    @endif
                                @empty
                                    <div>No notifications found.</div>
                                @endforelse
                                
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                {{-- User Registration Notification --}}
                <li class="nav-item topbar-icon dropdown hidden-caret">
                    <a class="nav-link dropdown-toggle" href="#" id="registrationDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-plus"></i>
                        @php
                            // Filter notifications for new registrations
                            $registrationNotifications = $notifications->whereIn('type', [
                                'google Registration',
                                'Account Registration',
                            ]);
                        @endphp
                        @if ($registrationNotifications->count() > 0)
                            <span class="notification">{{ $registrationNotifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="registrationDropdown">
                        <li>
                            <div class="dropdown-title">
                                {{ $registrationNotifications->count() > 0 ? "You have {$registrationNotifications->count()} new registrations" : 'There are no new registrations' }}
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @forelse($registrationNotifications as $notification)
                                        @php
                                            // Decode the notification data
                                            $notificationData = json_decode($notification->data);
                                            // Log the notification data for debugging purposes
                                            \Log::info('Notification Data:', (array) $notificationData);
                                            // Safely get user ID
                                            $newUserId = $notificationData->user_id ?? null; // Ensure user ID is retrieved
                                        @endphp

                                        @if ($newUserId)
                                            <a
                                                href="{{ route('users.handle', ['id' => $notification->id, 'user_id' => $newUserId]) }}">
                                                <div class="notif-content">
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-xs me-2">
                                                            @php
                                                                $notificationUser = App\Models\User::find($notificationData->user_id);
                                                                $userImage = $notificationUser->image ? asset('storage/' . $notificationUser->image) : asset('assets/img/default-avatar.png');
                                                            @endphp
                                                            <img src="{{ $userImage }}" alt="User Image" class="avatar-img rounded-circle" />
                                                        </div>
                                                        
                                                        
                                                        <div>
                                                            <span
                                                                class="block">{{ $notificationData->message ?? 'No message' }}</span>
                                                            <span class="block">Full Name:
                                                                {{ $notificationData->user_name ?? 'Unknown User' }}</span>
                                                            <span class="block">Email:
                                                                {{ $notificationData->user_email ?? 'No Email' }}</span>
                                                            <span
                                                                class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-divider"></div>
                                                </div>
                                            </a>
                                        @else
                                            <p class="text-center text-warning">User ID is missing for this
                                                notification. You can still view the message details.</p>
                                        @endif
                                    @empty
                                        {{-- <p class="text-center">No new registrations available</p> --}}
                                    @endforelse
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}"
                                alt="User Avatar" class="avatar-img rounded-circle" />
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
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}"
                                            alt="User Avatar" class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                        <a href="{{ route('adminprofile') }}"
                                            class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}"><i
                                        class="fa fa-home me-2"></i>Home</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa fa-sign-out-alt me-2"
                                            style="color: red"></i>Logout</button>
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


{{-- 
<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('status') }}" class="logo">
                <img src="{{ asset('assets/img/masterpeace_logo__1_-removebg-preview.png') }}" alt="navbar brand"
                    class="navbar-brand" height="20" />
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
                    <a class="nav-link dropdown-toggle" href="{{ route('notifications') }}" id="notifDropdown"
                        role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <!-- Icon for user registration -->
                        @if ($notifications->contains(fn($notification) => json_decode($notification->data)->type === 'Account Registration'))
                            <i class="fa fa-user-plus" style="color: green; margin-left: 8px;"></i>
                        @endif
                        @if ($notifications->count() > 0)
                            <span class="notification">{{ $notifications->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                        <li>
                            <div class="dropdown-title">
                                {{ $notifications->count() > 0 ? "You have {$notifications->count()} new notifications" : 'There are no notifications' }}
                            </div>
                        </li>
                        <li>
                            <div class="notif-scroll scrollbar-outer">
                                <div class="notif-center">
                                    @forelse($notifications as $notification)
                                        @php
                                            $notificationData = json_decode($notification->data);
                                            dd($notificationData);

                                        @endphp
                                        <a href="{{ route('notifications.handle', ['id' => $notification->id, 'order_id' => $notificationData->order_id]) }}">
                                            <div class="notif-content">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-xs me-2">
                                                        <img src="{{ $notificationData->user_image ?? asset('assets/img/default-avatar.png') }}"
                                                            alt="User Image" class="avatar-img rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <span class="block">
                                                            {{ $notificationData->message ?? 'No message' }}
                                                            @if (isset($notificationData->type) && $notificationData->type === 'Account Registration')
                                                            <i class="fa fa-user-plus" style="color: green; margin-left: 8px;"></i>
                                                        @endif
                                                        
                                                        </span>
                                                        <span class="block">User: {{ $notificationData->user_name ?? 'Unknown User' }}</span>
                                                        <span class="block">Email: {{ $notificationData->user_email ?? 'No Email' }}</span>
                                                        <span class="time">{{ $notification->created_at->diffForHumans() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <p class="text-center">No notifications available</p>
                                    @endforelse
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Profile -->
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}"
                                alt="User Avatar" class="avatar-img rounded-circle" />
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
                                        <img src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('assets/img/default-avatar.png') }}"
                                            alt="User Avatar" class="avatar-img rounded-circle" />
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                        <p class="text-muted">{{ Auth::user()->email }}</p>
                                        <a href="{{ route('adminprofile') }}" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('home') }}"><i class="fa fa-home me-2"></i>Home</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="fa fa-sign-out-alt me-2"
                                            style="color: red"></i>Logout</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div> --}}
