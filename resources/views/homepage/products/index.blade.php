<!-- resources/views/products/category.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $category->name }} Products</title>
    <link rel="stylesheet" href="../assets/css/homepage.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('homepage.homenav.homenav')

    <section class="product_section">
        <h1 class="section_title">Products in {{ $category->name }}</h1>
        <div class="product_grid">
            @forelse ($products as $product)
                <div class="product_card">
                    <h3 class="product_name">{!! wrapText($product->name, 15) !!} </h3>
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image" />
                    {{-- <p class="product_description">{!! wrapText($product->description, 30) !!} </p> --}}
                    {{-- <p class="product_price">Price: <span class="price_value">${{ $product->price }}</span></p> --}}
                    <a class="product_link" href="{{ route('product.show', $product->id) }}">View Details</a>
                </div>
            @empty
                <p>No products found in this category.</p>
            @endforelse
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
