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
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        color: #4a098b box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
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
        <img class="header_img" src="assets/img/home/masterpeace_logo-removebg-preview.png" alt="Logo" />
    </div>
    <button class="menu-toggle" aria-label="Open menu">
        <span class="menu-icon"></span>
    </button>
    <section class="links">
        <a href="{{ route('home') }}">Home</a>
        <a href="#">Create</a>
        <a href="#">About</a>
        <a href="#">Faq</a>

        @auth <!-- Check if the user is logged in -->
            <div class="dropdown">
                <!-- Display user name with a dropdown -->
                <button class="dropbtn">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                </button>
                <div class="dropdown-content">
                  @if (Auth::user()->role === 'admin')
                      <!-- If the user is an admin, add admin links -->
                      \
                      <a class="dropdown-item" href="{{ route('dashboard.maindasboard') }}">Dashboard</a>
                      <!-- Add more admin-specific links here -->
                  @endif
                    {{-- <a class="dropdown-item" href="#">My Balance</a>
                    <a class="dropdown-item" href="#">Inbox</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('userprofile') }}">Profile</a>
                    <div class="dropdown-divider"></div>

                    <!-- Logout button inside the dropdown -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <!-- Display login link if the user is not logged in -->
            <a href="{{ route('login') }}">Login</a>
        @endauth
    </section>
</header>
