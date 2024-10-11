<style>
    /* Basic dropdown styling */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background-color: transparent;
        color: #d8af53;
        padding: 10px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        display: flex; /* Use flex to align items */
        align-items: center; /* Vertically center the items */
    }

    .dropbtn i {
        margin-left: 5px; /* Space between the text and icon */
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        color: #4a098b;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a,
    .dropdown-content form button {
        color: #d8af53;
        padding: 12px 30px;
        text-decoration: none;
        display: block;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-content a:hover,
    .dropdown-content form button:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-divider {
        height: 1px;
        margin: .5rem 0;
        overflow: hidden;
        background-color: #e9ecef;
    }
</style>

<header>
    <div>
        <img class="header_img" src="{{asset('assets/img/home/masterpeace_logo-removebg-preview.png')}}" alt="Logo" />
    </div>
    <button class="menu-toggle" aria-label="Open menu">
        <span class="menu-icon"></span>
    </button>
    <section class="links">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('orders.index') }}" >Your Orders</a>
        <a href="#">About</a>
        <a href="#">Faq</a>

        @auth <!-- Check if the user is logged in -->
            <div class="dropdown">
                <!-- Display user name with a dropdown -->
                <button class="dropbtn">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    <i class="fas fa-caret-down"></i> <!-- Arrow icon -->
                </button>
                <div class="dropdown-content">
                    @if (Auth::user()->role === 'admin')
                        <!-- If the user is an admin, add admin links -->
                        <a class="dropdown-item" href="{{ route('dashboard.maindasboard') }}">Dashboard</a>
                        <!-- Add more admin-specific links here -->
                    @endif
                    @if (Auth::user()->role !== 'admin')
                        {{-- <div class="dropdown-divider"></div> --}}
                        <a class="dropdown-item" href="{{ route('userprofile') }}">Profile</a>
                        <div class="dropdown-divider"></div>
                    @endif

                    <!-- Logout link that submits the hidden form -->
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>

            <!-- Hidden logout form -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf <!-- Ensure CSRF token is included -->
            </form>
        @else
            <!-- Display login link if the user is not logged in -->
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </section>
</header>

