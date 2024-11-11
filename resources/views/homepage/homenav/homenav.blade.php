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
         {{-- header top start --}}
         <div class="header_top">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-lg-6 col-md-6">
                         <div class="social_icons">

                             <ul>
                                 <li>
                                     <a href="#"><i class="fab fa-facebook-f"></i></a>
                                 </li>
                                 <li>
                                     <a href="#"><i class="fab fa-twitter"></i></a>
                                 </li>
                                 <li>
                                     <a href="#"><i class="fab fa-instagram"></i></a>
                                 </li>
                                 <li>
                                     <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                 </li>
                             </ul>

                         </div>
                     </div>
                     <div class="col-lg-6 col-md-6">
                         <div class="top_right text-right">
                             <ul>
                                 <li class="language">
                                     <a href="#">English <i class="ion-chevron-down"></i></a>
                                     <ul class="dropdown_language">
                                         <li><a href="#">English</a></li>
                                         <li><a href="#">French</a></li>
                                         <li><a href="#">German</a></li>
                                     </ul>
                                 </li>
                                 <li class="currency">
                                     <a href="#">USD <i class="ion-chevron-down"></i></a>
                                     <ul class="dropdown_currency">
                                         <li><a href="#">EUR</a></li>
                                         <li><a href="#">GBP</a></li>
                                         <li><a href="#">INR</a></li>
                                     </ul>
                                 </li>

                                 <li class="top_links">
                                     <a href="#">My Account <i class="ion-chevron-down"></i></a>
                                     <ul class="dropdown_links">
                                         <li><a href="#">checkout</a></li>
                                         <li><a href="#">shopping cart</a></li>

                                         @if (Auth::check())
                                             <li>
                                                 <a href="#"
                                                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                             </li>
                                         @else
                                             <li>

                                                 <a href="{{ route('login') }}">Login</a>
                                             </li>
                                         @endif
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                             style="display: none;">
                                             @csrf
                                         </form>
                                         @if (Auth::check())
                                             <li>
                                                 <a href="{{ route('userprofile', Auth::user()->id) }}">Profile</a>
                                             </li>
                                         @endif
                                     </ul>
                                 </li>




                             </ul>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
         {{-- header top end --}}

         {{-- header middle start --}}
         <div class="header_middle">
             <div class="container">
                 <div class="row align-items-center">
                     <div class="col-lg-5">
                         <div class="home_contact">
                             <div class="contact_icone">
                                 <img style="width: 50px" src="{{ asset('assets/img/home/BRACELETS.jpg') }}"
                                     alt="">
                             </div>
                             <div class="contact_box">
                                 <p>inquiry / support: <a href="tel:123456789"></a> 123456789 </p>
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-2 col-md-3 col-4">
                         <div class="logo">
                             <a href="{{ route('home') }}">
                                 <img src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}"
                                     alt="Logo" />
                             </a>
                         </div>
                     </div>

                     <div class="col-lg-5 col-md-7 col-6">
                         <div class="middle_right">
                             <div class="search_btn">
                                 <a href="#"> <i class="ion-ios-search-strong"></i> </a>
                                 <div class="dropdown_search">
                                     <form action="#">
                                         <input type="text" placeholder="Search for products">
                                         <button type="submit"><i class="ion-ios-search-strong"></i></button>
                                     </form>
                                 </div>
                             </div>
                             <div class="wishlist_btn">
                                 <a href=""> <i class="ion-ios-heart"></i></a>
                             </div>
                             <div class="cart_link">
                                 {{-- add the cart number or the value and the cart it self --}}
                                 <a href=""> <i class="ion-android-cart"></i> <span
                                         class="cart_text_quantity">Rs. 67598 <i class="ion-chevron-down"></i>
                                         </span"></a>
                                 <span class="cart_quantity">2</span>
                                 {{-- mini cart --}}
                                 {{-- add a foreach to it --}}
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
                                             <a href="#"><img src="{{ asset('assets/img/home/BRACELETS.jpg') }}"
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
                                             <a href="#"><img src="{{ asset('assets/img/home/BRACELETS.jpg') }}"
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
                                             <a href="#">view cart</a>
                                         </div>
                                         <div class="cart_button checkout">
                                             <a href="#" class="active">checkout</a>
                                         </div>
                                     </div>
                                 </div>
                                 {{-- mini cart end --}}
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>


         {{-- header middle end --}}

         {{-- header bottom start --}}
         <div class="header_bottom sticky-header">
             <div class="contaner">
                 <div class="row align-items-center">
                     <div class="col-12">
                         <div class="main_menu_inner">
                             <div class="logo_sticky">
                                 <a href=" {{ route('home') }}"> <img
                                         src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}"
                                         alt=""></a>
                             </div>
                             <div class="main_menu">
                                 <nav>
                                     <ul>
                                         <li class="active">
                                             <a href=" {{ route('home') }}">home<i class="ion-chevron-down"></i></a>
                                             <ul class="sub_menu">
                                                 <li><a href="#">Banner</a></li>
                                                 <li><a href="#">featured</a></li>
                                                 <li><a href="#">collection</a></li>
                                                 <li><a href="#">best selling</a></li>
                                                 <li><a href="#">news</a></li>
                                                 <li><a href="#">blogs</a></li>
                                             </ul>
                                         </li>
                                         <li>
                                             <a href="#">category <i class="ion-chevron-down"></i></a>
                                             <ul class="mega_menu">
                                                 <li>
                                                     <a href="#">women</a>
                                                     <ul>

                                                         <li><a href="#">Bracelets</a></li>
                                                         <li><a href="#">Earrings</a></li>
                                                         <li><a href="#">Rings</a></li>
                                                         <li><a href="#">Necklace</a></li>
                                                         <li><a href="#">Pendants</a></li>
                                                         <li><a href="#">Bangles</a></li>
                                                     </ul>
                                                 </li>
                                                 <li>
                                                     <a href="#">men</a>
                                                     <ul>

                                                         <li><a href="#">reings</a></li>
                                                         <li><a href="#">pandants</a></li>
                                                         <li><a href="#">braselets</a></li>
                                                         <li><a href="#">chains</a></li>
                                                         <li><a href="#">gemstones</a></li>
                                                     </ul>
                                                 </li>

                                             </ul>
                                         </li>
                                         <li>
                                             <a href="#">uncut dimonds <i class="ion-chevron-down"></i></a>
                                             <ul class="sub_menu pages">
                                                 <li><a href="#">earings</a></li>
                                                 <li><a href="#">pandiants</a></li>
                                                 <li><a href="#">rings</a></li>
                                                 <li><a href="#">braselets</a></li>
                                             </ul>
                                         </li>
                                         <li><a href="#">About Us</a></li>
                                         <li><a href="#">Contact</a></li>
                                     </ul>
                                 </nav>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>
         {{-- header bottom end --}}

     </header>

     <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" >
    </script>
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



 <script src="https://kit.fontawesome.com/a49038f582.js" crossorigin="anonymous"></script>
 <script src="{{ asset('assets/js/homepage.js') }}"></script>
