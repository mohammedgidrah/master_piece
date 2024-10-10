<!-- resources/views/products/show.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {{-- <title>{{ $product->name }}</title> --}}
    <title>product details</title>
    <link rel="stylesheet" href="../assets/css/homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="../assets/img/home/masterpeace_logo-removebg-preview.png" />

</head>

<body>
    @include('homepage.homenav.homenav')

    <section class="product_detail_section">
        <div class="product_detail_container">
            <h1 class="product_name"> {!! wrapText($product->name, 15) !!}</h1>
            <div class="product_details">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image" />
                <div class="description">

                    <h2>description:</h2>
                    <p class="product_description">{!! wrapText($product->description, 30) !!} </p>
                </div>
            </div>
            <p class="product_price">Price: <span class="price_value">${{ $product->price }}</span></p>
            <a href="{{ route('category.products', $product->category_id) }}" class="back_to_category">Back to Category</a>
        </div>
    </section>

    <script src="../assets/js/homepage.js"></script>
</body>

</html>

@php
function wrapText($text, $length = 50) {
    return nl2br(wordwrap($text, $length, "\n", true));
}
@endphp
