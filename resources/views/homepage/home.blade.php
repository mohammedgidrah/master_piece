<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"> --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"> --}}
    {{-- <link rel="stylesheet" href="assets/css/homepage.css" /> --}}

</head>

<body style="height: 1000px">
    <div class="home_black_virsion">
        @include('homepage.homenav.homenav')


        {{-- slider section start --}}
        <div class="slider_area slider_black owl-carousel">
            <div class="single_slider" data-bgimg="{{ asset('assets/img/slider/arashmil.jpg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive collection</p>
                                <h1>neckales</h1>
                                <span>22 craet gold</span>
                                <p class="slider_price">starting at <span>Rs 75,999</span></p>
                                {{-- fix the product to add it to the cart --}}
                                <a href="" class="button">shop now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="single_slider" data-bgimg="{{ asset('assets/img/slider/bg-404.jpeg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive collection</p>
                                <h1>aqswdef</h1>
                                <span>22 craet gold</span>
                                <p class="slider_price">starting at <span>Rs 75,999</span></p>
                                {{-- fix the product to add it to the cart --}}
                                <a href="" class="button">shop now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="single_slider" data-bgimg="{{ asset('assets/img/slider/chadengle.jpg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive collection</p>
                                <h1>neckales</h1>
                                <span>22 craet gold</span>
                                <p class="slider_price">starting at <span>Rs 75,999</span></p>
                                {{-- fix the product to add it to the cart --}}
                                <a href="" class="button">shop now</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        {{-- slider section end --}}
        {{-- banner section start --}}
        {{-- banner section end --}}
        <section class="banner_section banner_black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href=""><img src="{{ asset('assets/img/home/hero-removebg-preview.png') }}"
                                        alt=""></a>
                                <div class="banner_content">
                                    <p>new design</p>
                                    <h2>small design ring</h2>
                                    <span> sale 20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href=""><img src="{{ asset('assets/img/home/hero-removebg-preview.png') }}"
                                        alt=""></a>
                                <div class="banner_content">
                                    <p>new design</p>
                                    <h2>small design ring</h2>
                                    <span> sale 20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href=""><img src="{{ asset('assets/img/home/hero-removebg-preview.png') }}"
                                        alt=""></a>
                                <div class="banner_content">
                                    <p>new design</p>
                                    <h2>small design ring</h2>
                                    <span> sale 20%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </div>



    {{-- <section class="hero_section">
        <img class="hero_section_img" src="assets/img/home/hero-removebg-preview.png" alt="" />
        <div class="hero_text">
            <h1>Discover the Brilliance of Nature</h1>
            <p>Explore our exclusive collection of rare and exquisite gemstones, each telling its own unique story.</p>
            @if (!Auth::check())
                <a href="{{ route('login') }}" class="call_to_actione">Join Us</a>
            @endif
        </div>
    </section>

    <section class="category_section">
        <div>
            <h1 class="category_heading">Our Categories</h1>
        </div>
    </section>

    <div class="All_category">
        @if ($categories->isEmpty())
            <p>No categories found.</p>
        @else
            @foreach ($categories as $category)
                <div class="category_card">
                    <h3 class="category_name">{{ $category->name }}</h3>
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                        class="category_img" />
                    <a class="category_link" href="{{ route('category.products', $category->id) }}">More details</a>
                </div>
            @endforeach
        @endif
    </div>
    </section>

    <div class="container">
        <div class="text-section">
            <h2>Buy Gemstones Online</h2>
            <h1>Precious Stones, Semi-Precious Stones, Astrological Stones or Rashi Ratna.</h1>
        </div>
        <section class="image-section">
            <div class="item">
                <p>Adorn Perfection</p>
                <h3>PENDANTS</h3>
                <img src="assets/img/home/PENDANTS.jpg" class="category_img" alt="Pendants">
            </div>
            <div class="item">
                <p>Embrace Preciousness</p>
                <h3>BRACELETS</h3>
                <img src="assets/img/home/BRACELETS.jpg" class="category_img" alt="Bracelets">
            </div>
        </section>
    </div> --}}


    <script src="{{ asset('assets/js/homepage.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
</body>

</html>
