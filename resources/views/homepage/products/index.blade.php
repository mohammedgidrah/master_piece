<!-- resources/views/products/category.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>product in {{ $category->name }}</title>
    <link rel="stylesheet" href="../assets/css/homepage.css" />
    <link rel="icon" type="image/png" href="../assets/img/home/masterpeace_logo-removebg-preview.png" />

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />
    <!-- Social Media and Open Graph Tags -->
    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="assets/img/home/masterpeace_logo-removebg-preview.png" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />
</head>
<style>
    .product_section {
        background-color: #242424;
        color: #fff;

    }


    p {
        color: white;
        text-align: start;
    }

    a {
        color: #a0a0a0;
        text-decoration: none;
    }

    a:hover {
        color: black;
    }

    h3 {
        text-align: start;
    }

    ul {
        text-align: start;
        padding: 0;
        margin: 0;
    }

 
</style>

<body >
    @include('homepage.homenav.homenav')

    <section class="product_section">
    <h1 class="section_titles">Products in {{ $category->name }}</h1>
    <div class="product_grid">
        @forelse ($products as $product)
            <div class="product_card">
                <h3 class="product_name">{!! wrapText($product->name, 15) !!} </h3>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image"
                style="width: 200px; height: 275px; display: block; margin: 10px auto;" />

                <a class="product_link" href="{{ route('show.product', $product->id) }}">View Details</a>
            </div>
        @empty
            <p style="text-align: center; margin-top: 20px; font-size: 20px; color: white">No products found in this
                category back to <a href="{{ route('home') }}" style="text-decoration: none;color: #d8af53"> home</a>
            </p>
        @endforelse
    </div>
</section>
@include('homepage.footer.footer')

 
     <script src="../assets/js/homepage.js"></script>
</body>

</html>

@php
    if (!function_exists('wrapText')) {
        function wrapText($text, $length = 50)
        {
            return nl2br(wordwrap($text, $length, "\n", true));
        }
    }
@endphp
