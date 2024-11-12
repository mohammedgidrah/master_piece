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

</head>
<style>
    /* File: resources/assets/css/homepage.css */
    body {
        height: 100vh;
        background-color: #242424;
        color: #fff;
         margin: 0;
        padding: 0;
    }

    .product_section {
        padding: 2rem;
        text-align: center;
    }

    .section_titles {
        font-size: 2rem;
        margin-bottom: 1.5rem;
        color: #d8af53;
        padding-top: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .product_grid {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        justify-content: center;
    }

    .product_card {
        background-color: #222;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        overflow: hidden;
        width: 220px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product_card:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.5);
    }

    .product_name {
        font-size: 1.2rem;
        color: #d8af53;
        margin: 10px 0;
        text-align: center;
        padding: 0 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product_image {
        width: 100%;
        height: 150px;
        object-fit: cover;
        display: block;
        margin: 10px auto;
        border-bottom: 1px solid #333;
    }

    .product_link {
        display: inline-block;
        margin: 15px auto;
        padding: 8px 16px;
        font-size: 0.9rem;
        color: #fff;
        background-color: #d8af53;
        text-transform: uppercase;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .product_link:hover {
        background-color: #b4933f;
    }

    p {
        color: white;
        /* font-size: 1.2rem;
        margin-top: 2rem; */
        text-align: start;
    }

    a {
        color: #a0a0a0;
        text-decoration: none;
    }

    a:hover {
        color: black;
    }
    h3{
        text-align: start;
    }
    ul{
        text-align: start;
        padding: 0;
        margin: 0;
    }
 
    footer{
        margin-top: 20px;
    }

</style>

<body style="height: 100vh;>
    @include('homepage.homenav.homenav')

    <section class="product_section">
    <h1 class="section_titles">Products in {{ $category->name }}</h1>
    <div class="product_grid">
        @forelse ($products as $product)
            <div class="product_card">
                <h3 class="product_name">{!! wrapText($product->name, 15) !!} </h3>
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image"
                    style="width: 200px; height: 150px; display: block; margin: 10px   auto;" />

                <a class="product_link" href="{{ route('show.product', $product->id) }}">View Details</a>
            </div>
        @empty
            <p style="text-align: center; margin-top: 20px; font-size: 20px; color: white">No products found in this
                category back to <a href="{{ route('home') }}" style="text-decoration: none;color: #d8af53"> home</a>
            </p>
        @endforelse
    </div>
    @include('homepage.footer.footer')
    </section>

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
