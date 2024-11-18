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
        {{-- banner section start --}}

        {{-- @if ($categories->isEmpty())
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
    @endif --}}
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
                                    <a  href="{{ route('category.products', $category->id) }}">
                                        <img class="sign_img" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
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
    
        {{-- <section class="banner_section banner_black">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="{{ asset('assets/images/banner/bg-1.jpg') }}" alt="banner1"></a>
                                <div class="banner_content">
                                    <p>New Design</p>
                                    <h2>Small design Rings</h2>
                                    <span>Sale 20% </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="{{ asset('assets/images/banner/bg-2.jpg') }}" alt="banner2"></a>
                                <div class="banner_content">
                                    <p>Bestselling Rings</p>
                                    <h2>White gold rings</h2>
                                    <span>Sale 10% </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_banner">
                            <div class="banner_thumb">
                                <a href="#"><img src="{{ asset('assets/images/banner/bg-3.jpg') }}" alt="banner3"></a>
                                <div class="banner_content">
                                    <p>Featured Rings</p>
                                    <h2>Platinium Rings</h2>
                                    <span>Sale 30% </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        {{-- banner section end --}}

        {{-- category section start --}}
        {{-- <section class="category_section p_section1 category_black_section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="category_area">
                            <div class="category_tab_button">
                                <ul class="nav" role="tablist">
                                    <li>
                                        <a href="#featured" class="active" data-toggle="tab" role="tab"
                                            aria-controls="featured" aria-selected="true">Featured</a>
                                    </li>
                                    <li>
                                        <a href="#arrivals" data-toggle="tab" role="tab" aria-controls="arrivals"
                                            aria-selected="false">New Arrivals</a>
                                    </li>
                                    <li>
                                        <a href="#onsale" data-toggle="tab" role="tab" aria-controls="onsale"
                                            aria-selected="false">On-Sale</a>
                                    </li>

                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="featured" role="tabpane1">
                                    <div class="category_container">
                                        <div class="custom-row category_column3">
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="{{ asset('assets/images/category/1.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="{{ asset('assets/images/category/2.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Necklace</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="{{ asset('assets/images/category/3.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="{{ asset('assets/images/category/4.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Earrings</a></h3>
                                                        <div class="price_box">

                                                            <span class="current_price">Rs. 45015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/5.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/6.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bracelet</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 75654</span>
                                                            <span class="current_price">Rs. 74015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/7.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/8.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bangles</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/9.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/10.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Gemstones</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/11.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/12.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Wedding set</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{   asset('assets/images/category/13.jpg')}} "
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/14.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Nose Pin</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/15.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src=" {{ asset('assets/images/category/16.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Diamonds</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src=" {{ asset('assets/images/category/17.jpg') }}"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="{{ asset('assets/images/category/18.jpg') }}" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Ring</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
       
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="arrivals" role="tabpane1">
                                    <div class="category_container">
                                        <div class="custom-row category_column3">
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/25.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/26.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Necklace</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/27.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/28.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Earrings</a></h3>
                                                        <div class="price_box">

                                                            <span class="current_price">Rs. 45015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/29.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/30.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bracelet</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 75654</span>
                                                            <span class="current_price">Rs. 74015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/31.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/32.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bangles</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/33.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/34.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Gemstones</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/35.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/36.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Wedding set</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/37.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/38.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Nose Pin</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/39.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/40.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Diamonds</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/41.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/42.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Ring</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/43.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/44.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Couple Ring</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/45.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/46.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bracelet</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/47.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/48.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Necklace Set</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="onsale" role="tabpane1">
                                    <div class="category_container">
                                        <div class="custom-row category_column3">
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/49.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/50.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Necklace</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/2.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/3.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Earrings</a></h3>
                                                        <div class="price_box">

                                                            <span class="current_price">Rs. 45015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/4.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/5.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bracelet</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 75654</span>
                                                            <span class="current_price">Rs. 74015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/6.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/7.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bangles</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/8.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/9.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Gemstones</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/10.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/11.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Wedding set</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/12.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/13.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Nose Pin</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/14.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/15.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Diamonds</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/16.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/17.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Ring</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/20.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/21.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Couple Ring</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/70.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/28.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Bracelet</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-col-5">
                                                <div class="single_category">
                                                    <div class="category_thumb">
                                                        <a href="#" class="primary_img"><img src="images/category/71.jpg"
                                                                alt="category1"></a>
                                                        <a href="#" class="secondary_img"><img
                                                                src="images/category/72.jpg" alt="category1"></a>
                                                        <div class="quick_button">
                                                            <a href="#" data-toggle="modal" data-target="#modal_box"
                                                                data-placement="top"
                                                                data-original-title="quick view">Quick View</a>
                                                        </div>
                                                    </div>
                                                    <div class="category_content">
                                                        <div class="tag_cate">
                                                            <a href="#">Ring, Necklace</a>
                                                            <a href="#">Earrings</a>
                                                        </div>
                                                        <h3><a href="#">Necklace Set</a></h3>
                                                        <div class="price_box">
                                                            <span class="old_price">Rs. 45654</span>
                                                            <span class="current_price">Rs. 44015</span>
                                                        </div>
                                                        <div class="category_hover">
                                                            <div class="category_ratings">
                                                                <ul>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                    <li><a href="#"><i
                                                                                class="ion-ios-star-outline"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="category_desc">
                                                                <p>This is a gold ring with diamond and Lorem ipsum
                                                                    dolor sit amet.</p>
                                                            </div>
                                                            <div class="action_links">
                                                                <ul>
                                                                    <li><a href="#" data-placement="top"
                                                                            title="Add to Wishlist"
                                                                            data-toggle="tooltip"><span
                                                                                class="ion-heart"></span></a></li>
                                                                    <li class="add_to_cart"><a href="#"
                                                                            title="Add to Cart">Add to Cart</a></li>
                                                                    <li><a href="#" title="Compare"><i
                                                                                class="ion-ios-settings-strong"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        {{-- category section end --}}
        <!-- blog section starts -->
        {{-- <section class="blog_section blog_black">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2>Ashirwaad Updates</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="blog_wrapper blog_column3 owl-carousel">
                    <div class="col-lg-4">
                        <div class="single_blog">
                            <div class="blog_thumb">
                                <a href="#"><img src="images/blog/4.jpg" alt="blog 4"></a>
                            </div>
                            <div class="blog_content">
                                <h3><a href="#">Earrings for Navratri</a></h3>
                                <div class="author_name">
                                    <p>
                                        <span>by</span>
                                        <span class="themes">Ashirwaad</span>
                                        <span class="post_by">/ 4 November 2020</span>
                                    </p>
                                </div>

                                <div class="post_desc">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit commodi
                                        quo eligendi laudantium quisquam, magnam hic numquam fuga illum sed aperiam
                                        sint, expedita dolor.</p>
                                </div>
                                <div class="read_more">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single_blog">
                            <div class="blog_thumb">
                                <a href="#"><img src="images/blog/1.jpg" alt="blog 1"></a>
                            </div>
                            <div class="blog_content">
                                <h3><a href="#">Pendant for engagement</a></h3>
                                <div class="author_name">
                                    <p>
                                        <span>by</span>
                                        <span class="themes">Ashirwaad</span>
                                        <span class="post_by">/ 3 November 2020</span>
                                    </p>
                                </div>

                                <div class="post_desc">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit commodi
                                        quo eligendi laudantium quisquam, magnam hic numquam fuga illum sed aperiam
                                        sint, expedita dolor.</p>
                                </div>
                                <div class="read_more">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single_blog">
                            <div class="blog_thumb">
                                <a href="#"><img src="images/blog/2.jpg" alt="blog 2"></a>
                            </div>
                            <div class="blog_content">
                                <h3><a href="#">Engagement Couple Rings</a></h3>
                                <div class="author_name">
                                    <p>
                                        <span>by</span>
                                        <span class="themes">Ashirwaad</span>
                                        <span class="post_by">/ 2 November 2020</span>
                                    </p>
                                </div>

                                <div class="post_desc">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit commodi
                                        quo eligendi laudantium quisquam, magnam hic numquam fuga illum sed aperiam
                                        sint, expedita dolor.</p>
                                </div>
                                <div class="read_more">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single_blog">
                            <div class="blog_thumb">
                                <a href="#"><img src="images/blog/3.jpg" alt="blog 3"></a>
                            </div>
                            <div class="blog_content">
                                <h3><a href="#">Earrings for Party</a></h3>
                                <div class="author_name">
                                    <p>
                                        <span>by</span>
                                        <span class="themes">Ashirwaad</span>
                                        <span class="post_by">/ 5 November 2020</span>
                                    </p>
                                </div>

                                <div class="post_desc">
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt fugit commodi
                                        quo eligendi laudantium quisquam, magnam hic numquam fuga illum sed aperiam
                                        sint, expedita dolor.</p>
                                </div>
                                <div class="read_more">
                                    <a href="#">Continue Reading</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
        <!-- blog section ends -->
        <!-- instagram section starts -->
        {{-- <div class="instagram">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-1.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-2.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-3.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-4.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-5.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                            <div class="instagram__item set-bg" data-bgimg="images/instagram/insta-6.jpg">
                                <div class="instagram__text">
                                    <i class="ion-social-instagram"></i>
                                    <a href="#">@ Ashirwaad</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        <!-- instagram section  ends-->
        <!-- subscribe section starts -->
        {{-- <div class="newsletter_area newsletter_black">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="newsletter_content">
                            <h2>Subscribe for Ashirwaad Magazines</h2>
                            <p>Get E-mail of all the updates about our lastest and special offers</p>
                            <div class="subscibe_form">
                                <form class="footer-newsletter">
                                    <input type="email" placeholder="Email address ..." autocapitalize="off"
                                        autocomplete="off">
                                    <button>Subscribe</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- subscribe section ends -->
        <!-- banner area starts  -->
        {{-- <section class="banner_section banner_section_five">
                    <div class="container-fluid p-0">
                        <div class="row no-gutters">
                            <div class="col-lg-6 col-md-12">
                                <div class="port-box">
                                    <div class="text-overlay">
                                        <h1>New Arrivals 2020</h1>
                                        <p>Crown for wife</p>
                                    </div>
                                    <img src="images/banner/1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="port-box">
                                    <div class="text-overlay">
                                        <h1>Featured categorys 2020</h1>
                                        <p>Pendant for Valentine</p>
                                    </div>
                                    <img src="images/banner/2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
        <!-- banner area ends -->

        <!-- footer section starts -->
        @include('homepage.footer.footer')

        <!-- footer section ends -->
        <!-- modal section starts -->
        {{-- <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">
                                    <div class="tab-content category-details-large">
                                        <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="images/category/70.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab2" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="images/category/71.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab3" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="images/category/72.jpg" alt=""></a>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab4" role="tabpanel">
                                            <div class="modal_tab_img">
                                                <a href="#"><img src="images/category/73.jpg" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal_tab_button">
                                        <ul class="nav category_navactive owl-carousel" role="tablist">
                                            <li>
                                                <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab"
                                                    aria-controls="tab1" aria-selected="false"><img
                                                        src="images/category/70.jpg" alt=""></a>
                                            </li>
                                            <li>
                                                <a href="#tab2" class="nav-link" data-toggle="tab" role="tab"
                                                    aria-controls="tab2" aria-selected="false"><img
                                                        src="images/category/71.jpg" alt=""></a>
                                            </li>
                                            <li>
                                                <a href="#tab3" class="nav-link button_three" data-toggle="tab"
                                                    role="tab" aria-controls="tab3" aria-selected="false"><img
                                                        src="images/category/72.jpg" alt=""></a>
                                            </li>
                                            <li>
                                                <a href="#tab4" class="nav-link" data-toggle="tab" role="tab"
                                                    aria-controls="tab4" aria-selected="false"><img
                                                        src="images/category/73.jpg" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h2>Women's Necklace</h2>
                                    </div>
                                    <div class="modal_price mb-10">
                                        <span class="new_price">Rs. 51164</span>
                                        <span class="old_price">Rs. 54164</span>
                                    </div>
                                    <div class="see_all">
                                        <a href="#">See All Features</a>
                                    </div>
                                    <div class="modal_add_to_cart mb-15">
                                        <form action="#">
                                            <input type="number" min="0" max="100" step="1">
                                            <button type="submit">Add To Cart</button>
                                        </form>
                                    </div>
                                    <div class="modal_description mb-15">
                                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus quibusdam
                                            nisi voluptas consequatur tempora, recusandae nemo blanditiis eaque odit
                                            voluptatibus voluptatem, ipsa incidunt fugiat a.</p>
                                    </div>
                                    <div class="modal_social">
                                        <h2>Share this category</h2>
                                        <ul>
                                            <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                            <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                            <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                            <li><a href="#"><i class="ion-social-googleplus"></i></a></li>
                                            <li><a href="#"><i class="ion-social-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
        <!-- modal section ends -->



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

     <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" crossorigin="anonymous"></script>

</body>

</html>
