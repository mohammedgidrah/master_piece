<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

</head>

<body>
    <header class="header_area header_black">
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="main_menu_inner">
                        <div class="main_menu">
                            <nav>
                                <!-- Logo -->
                                <div class="logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" alt="Logo" />
                                    </a>
                                </div>

                                <!-- Navigation Links -->
                                <ul class="links">
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="#">About Us</a></li>
                                    <li>
                                        @auth
                                            <a href="#">
                                                {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                                                <i class="ion-chevron-down"></i>
                                            </a>
                                            <ul class="sub_menu">
                                                @if (auth()->user()->role === 'admin')
                                                    <li><a href="{{ route('dashboard.maindasboard') }}">Dashboard</a></li>
                                                @else
                                                    <li><a href="{{ route('userprofile') }}">Profile</a></li>
                                                @endif
                                                <li>
                                                    <a href="{{ route('logout') }}" 
                                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        @else
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endauth
                                    </li>
                                </ul>

                                <!-- Cart Section -->
                                <div class="cart_link">
                                    <a href="#">
                                        <i class="ion-android-cart"></i>
                                        <span class="cart_text_quantity">
                                            Rs. {{ number_format($cartTotal ?? 0, 2) }}
                                            <i class="ion-chevron-down"></i>
                                        </span>
                                    </a>
                                    <span class="cart_quantity">
                                        @if (auth()->check() && $cartCount >= 0)
                                            <span class="cart-counter">{{ $cartCount }}</span>
                                        @endif
                                    </span>
                                    <div class="mini_cart">
                                        <div class="cart_close">
                                            <div class="cart_text">
                                                <h3>Cart</h3>
                                            </div>
                                            <div class="mini_cart_close">
                                                <a href="javascript:void(0)"><i class="ion-android-close"></i></a>
                                            </div>
                                        </div>

                                        @if ($orders->isEmpty())
                                            <!-- Message when the cart is empty -->
                                            <p class="empty_cart_message">Your cart is empty!</p>
                                        @else
                                            @php $total = 0; @endphp
                                            @foreach ($orders as $order)
                                                @php
                                                    $product = $order->product;
                                                    $subtotal = $product->price * $order->quantity;
                                                    $total += $subtotal;
                                                @endphp
                                                <div class="cart_item">
                                                    <div class="cart_img">
                                                        <a href="#">
                                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                                        </a>
                                                    </div>
                                                    <div class="cart_info">
                                                        <a href="#">{{ $product->name }}</a>
                                                        <span class="quantity">Qty: {{ $order->quantity }}</span>
                                                        <span class="price_cart">Rs. {{ number_format($product->price, 2) }}</span>
                                                    </div>
                                                    <div class="cart_remove">
                                                        <a href="javascript:void(0);" 
                                                           onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();">
                                                            <i class="ion-android-close"></i>
                                                        </a>
                                                        <form id="delete-form-{{ $order->id }}" 
                                                              action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="cart_total">
                                                <span>Total: Rs. {{ number_format($total, 2) }}</span>
                                            </div>
                                            <div class="mini_cart_footer">
                                                <div class="cart_button view_cart">
                                                    <a href="{{ route('orders.index') }}">View Cart</a>
                                                </div>
                                                <div class="cart_button checkout">
                                                    <a href="{{ route('billing.create', ['orderId' => $order->id, 'productId' => $product->id]) }}" class="active">Checkout</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Menu Toggle -->
                                <button class="menu-toggle" aria-label="Toggle navigation">
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
    </header>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>
