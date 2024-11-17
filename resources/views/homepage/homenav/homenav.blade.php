<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

</head>

<body>



    <header class="header_area header_black">
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div>
                        <div class="main_menu_inner">

                            <div class="main_menu">
                                <nav>
                                    <!-- Logo -->
                                    <div class="logo">
                                        <a href="{{ route('home') }}">
                                            <img src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}"
                                                alt="Logo" />
                                        </a>
                                    </div>

                                    <!-- Navigation Links -->
                                    <ul class="links">

                                        <li>
                                            <a href="{{ route('home') }}">Home </a>

                                        </li>
                                        <li><a href="#">About Us</a></li>
                                        <li>
                                            @auth
                                                <a href="#">{{ auth()->user()->first_name }}
                                                    {{ auth()->user()->last_name }}
                                                    <i class="ion-chevron-down"></i></a>
                                                <ul class="sub_menu">
                                                    @if (Auth::user()->role === 'admin')
                                                        <li><a href="{{ route('dashboard.maindasboard') }}">Dashboard</a>
                                                        </li>
                                                    @else
                                                        <li><a href="{{ route('userprofile') }}">Profile</a></li>
                                                    @endif
                                                    <li><a href="{{ route('logout') }}"
                                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        style="display: none;">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            @else
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endauth
                                        </li>
                                    </ul>

                                    <!-- Cart Section -->

                                    <div class="cart_link">
                                        <a href="#">
                                            <i class="ion-android-cart"></i>
                                            <span class="cart_text_quantity">Rs. 67598 <i
                                                    class="ion-chevron-down"></i></span>
                                        </a>
                                        <span class="cart_quantity">
                                            @if (auth()->check() && $cartCount > 0)
                                                <span class="cart-counter">{{ $cartCount }}</span>
                                            @endif
                                        </span>
                                        <div class="mini_cart">
                                            <div class="cart_close">
                                                <div class="cart_text">
                                                    <h3>cart</h3>
                                                </div>
                                                <div class="mini_cart_close">
                                                    <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/img/home/BRACELETS.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="#">pendant</a>
                                                    <span class="quantity">Qty : 1</span>
                                                    <span class="price_cart">Rs. 67598 </span>
                                                </div>
                                                <div class="cart_remove">
                                                    <a href="#"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="cart_item">
                                                <div class="cart_img">
                                                    <a href="#"><img
                                                            src="{{ asset('assets/img/home/BRACELETS.jpg') }}"
                                                            alt=""></a>
                                                </div>
                                                <div class="cart_info">
                                                    <a href="#">pendant</a>
                                                    <span class="quantity">Qty : 1</span>
                                                    <span class="price_cart">Rs. 67598 </span>
                                                </div>
                                                <div class="cart_remove">
                                                    <a href="#"><i class="ion-android-close"></i></a>
                                                </div>
                                            </div>
                                            <div class="cart_total">
                                                <span>Subtotal: (add the total of the cart)</span>
                                                <span>Rs. 67598 </span>
                                            </div>
                                            <div class="mini_cart_footer">
                                                <div class="cart_button view_cart">
                                                    <a href="{{ route('orders.index') }}">view cart</a>
                                                </div>
                                                <div class="cart_button checkout">
                                                    <a href="#" class="active">checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="menu-toggle"  aria-label="Toggle navigation">
                                        <span class="menu-icon"></span>
                                        <span class="menu-icon"></span>
                                        <span class="menu-icon"></span>
                                    </button>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>

{{-- <header>
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
                    @else
                        <a class="dropdown-item" href="{{ route('userprofile') }}">Profile</a>
                    @endif
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
        @if (auth()->check() && $cartCount > 0)
            <span class="cart-counter">{{ $cartCount }}</span>
        @endif
    </a>
    
</header> --}}
