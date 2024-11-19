<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/homepage.css" />
</head>


<body style="height: 1000px">
    <div class="home_black_virsion">
        @include('homepage.homenav.homenav')


        {{-- slider section start --}}
        <div class="slider_area slider_black owl-carousel">
            <div class="single_slider" data-bgimg="{{ asset('assets/images/slider/1.png') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive offer -20% off this week</p>
                                <h1>Necklace</h1>
                                <span>22 Carat gold necklace for wedding</span>
                                <p class="slider_price">starting at <span>Rs. 75,999</span></p>
                                <a href="#" class="button">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="single_slider" data-bgimg="{{ asset('assets/images/slider/2.jpg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive offer -40% off this week</p>
                                <h1>Earings and Pendant</h1>
                                <span>Complete bridal set with white pearls</span>
                                <p class="slider_price">starting at <span>Rs. 89,499</span></p>
                                <a href="#" class="button">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="single_slider" data-bgimg="{{ asset('assets/images/slider/3.jpg') }}">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="slider_content">
                                <p>exclusive offer -10% off this week</p>
                                <h1>Wedding Rings</h1>
                                <span>Ashirwaad Special wedding rings for couples.</span>
                                <p class="slider_price">starting at <span>Rs. 14,999</span></p>
                                <a href="#" class="button">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- slider section end --}}
        <section class="banner_section banner_black">
            <div class="container">
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
                                                alt="{{ $category->name }}">
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





        @include('homepage.footer.footer')




    </div>



 



    <script src="{{ asset('assets/js/homepage.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"></script>

</body>

</html>
