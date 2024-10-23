<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Inter:wght@500&family=Karma:wght@300;400;500;600;700&family=Kaushan+Script&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>
</head>

<body>
    @include('homepage.homenav.homenav')

    <section class="hero_section">
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
    </div>


    {{-- <script src="{{ asset('assets/js/homepage.js') }}"></script> --}}
    <script src="https://kit.fontawesome.com/a49038f582.js" crossorigin="anonymous"></script>
</body>

</html>
