<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />

    <title>Handcrafted Gemstone Jewelry - MASA</title>

    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <!-- Social Media and Open Graph Tags -->
    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="assets/img/home/masterpeace_logo-removebg-preview.png" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/homepage.css" />
</head>

<body>
    <div class="home_black_virsion">
        @include('homepage.homenav.homenav')

        <!-- Slider Section Start -->
        <div class="slider_area slider_black owl-carousel">
            <div class="single_slider"
                data-bgimg="{{ asset('assets/img/home/slider/polished-stones-earthy-tones-glisten-with-reflected-light.jpg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>Discover the Brilliance of Nature</p>
                                <span>Explore our exclusive collection</span><br>
                                <span>of rare and exquisite gemstones</span><br>
                                <span>each telling its own unique story.</span><br>

                                @if (!Auth::check())
                                    <a href="{{ route('login') }}" class="button">Join Us</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat other slider items with similar structure -->

        </div>
        <!-- Slider Section End -->

        <!-- About Us Section Start -->
        <section class="about-us" id="about">
            <div class="container">
                <div class="about-content">
                    <h2 class="section-title">Who Are We</h2>
                    <p>
                        Welcome to <span class="highlight">MASA</span>, a website dedicated to handcrafted gemstone jewelry!
                        We specialize in creating unique, handmade jewelry featuring exquisite, natural gemstones. Each piece is carefully crafted with love and precision, bringing you timeless elegance and unmatched quality. Explore our collection and discover the perfect gem for every occasion!
                    </p>
                    <p>
                        With years of experience and a commitment to innovation, we aim to transform ideas into reality. Let us help you achieve your goals and build a better future together.
                    </p>
                </div>
                <div class="about-image">
                    <img src="assets/img/home/top-view-colorful-small-stone-collection.jpg" alt="Colorful gemstone collection showcasing the beauty of nature">
                </div>
            </div>
        </section>
        <!-- About Us Section End -->

        <!-- Categories Section Start -->
        <section class="banner_section banner_black" id="category">
            <div class="container">
                <h1 class="category_heading">Our Categories</h1>
                <div class="row">
                    @if ($categories->isEmpty())
                        <div class="col-lg-12">
                            <p class="no-categories">No categories found.</p>
                        </div>
                    @else
                        @foreach ($categories as $category)
                            <div class="col-lg-4 col-md-6">
                                <div class="single_banner">
                                    <div class="banner_thumb">
                                        <a href="{{ route('category.products', $category->id) }}">
                                            <img class="sign_img" src="{{ asset('storage/' . $category->image) }}"
                                                alt="Explore {{ $category->name }} category of gemstones">
                                        </a>
                                    </div>
                                    <div class="banner_content">
                                        <h2>{{ $category->name }}</h2>
                                        <p class="category-name">{{ $category->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <!-- Categories Section End -->

        <!-- Contact Section Start -->
        <section id="contact" class="scrollspy-section padding-large">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="left-content">
                            <div class="section-header">
                                <div class="title">
                                    <span>Get in Touch</span>
                                </div>
                            </div>
                            <p>If you have any questions, feel free to reach out. We're here to help!</p>

                            <form id="form-contact" class="form-light" action="{{ route('contact.submit') }}"
                                method="POST">
                                @csrf
                                <p>
                                    <input type="text" name="name" placeholder="Your Full Name*" required>
                                </p>
                                <p>
                                    <input type="email" name="email" placeholder="Your Email Address" required>
                                </p>
                                <p>
                                    <textarea name="message" placeholder="Your Message" required></textarea>
                                </p>
                                <button class="btn btn-accent btn-rounded btn-xlarge btn-full" type="submit">Submit</button>
                            </form>
                        </div>
                    </div><!-- Left Content -->

                    <div class="col-md-6">
                        <div class="right-content">
                            <img style="width: 450px;" src="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}"
                                alt="MASA Jewelry Logo">
                        </div>
                    </div><!-- Right Content -->

                </div>
            </div>
        </section>
        <!-- Contact Section End -->

        @include('homepage.footer.footer')
    </div>

    <script src="{{ asset('assets/js/homepage.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"></script>
</body>

</html>
