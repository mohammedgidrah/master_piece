<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
</head>

<body>
    @include('homepage.homenav.homenav')

    <section class="product_detail_section">
        <div class="product_detail_container">
            <h1 class="product_name">{!! wrapText($product->name, 30) !!}</h1>
            <div class="product_details">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image"   />
                <div class="description">
                    <h2>Description:</h2>
                    <p style="text-align: justify" class="product_description">{!! wrapText($product->description, 40) !!}</p>
                </div>
            </div>
            <p class="product_price">Price: <span class="price_value">${{ $product->price }}</span></p>
            <div class="button-container">
                @if(auth()->check())
                    <!-- Form is available only to logged-in users -->
                    @if (session('success'))
                        <div class="alert alert-success" style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('orders.store', $product->id) }}" method="POST" class="order_form">
                        @csrf
            
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger" style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="total_price" value="{{ $product->price }}">
                        <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="btn btn-primary">Store Product in Order</button>
                    </form>
                @else
                    <!-- Show message if the user is not logged in -->
                    <p class="alert alert-warning" style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                        You need to <a href="{{ route('login') }}" style="text-decoration: none">log in</a> first to place an order.
                    </p>
                @endif
            
                <a href="{{ route('category.products', $product->category_id) }}" class="btn btn-secondary">Back to Category</a>
            </div>
            
        </div>
    </section>
    

    <!-- Fix the JavaScript link -->
    <script src="{{ asset('./assets/js/homepage.js') }}"></script>
    <script>
        document.querySelector('.order_form').addEventListener('submit', function() {
            this.querySelector('button[type="submit"]').disabled = true;
        });
    </script>
</body>

</html>

@php
if (!function_exists('wrapText')) {
    function wrapText($text, $length = 50) {
        return nl2br(wordwrap($text, $length, "\n", true));
    }
}
@endphp
