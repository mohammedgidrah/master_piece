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
    a{
        text-decoration: none;
    }

    .cart-counter {
        position: relative;
        /* padding: 2px 5px; */
        border-radius: 50%;
        /* background-color: #4a098b; */
        font-weight: bold;
        text-align: center;
        top: -15px;
        /* margin-bottom: 5px; Space between icon and count */
        font-size: 14px; /* Size of the cart count */
        color: #d8af53; /* Color for the cart count */
    }
</style>
<header>
    <div>
        <img class="header_img" src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" alt="Logo" />
    </div>
    <button class="menu-toggle" aria-label="Open menu">
        <span class="menu-icon"></span>
    </button>
    <section class="links">
        <a href="{{ route('home') }}">Home</a>
        <a href="#">About</a>
        <a href="#">Faq</a>

        @auth
            <div class="dropdown">
                <button class="dropbtn">
                    {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    <i class="fas fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    @if (Auth::user()->role === 'admin')
                        <a class="dropdown-item" href="{{ route('dashboard.maindasboard') }}">Dashboard</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('userprofile') }}">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
        @endauth
        
    </section>
    <a   href="{{ route('orders.index') }}">
        <i class="fa-solid fa-cart-shopping" style="color: #d8af53; font-size: 20px"></i>
        @if(auth()->check() && $cartCount > 0)
            <span class="cart-counter">{{ $cartCount }}</span>
        @endif
    </a>
    
</header>



<script src="https://kit.fontawesome.com/a49038f582.js" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/homepage.js') }}"></script>
