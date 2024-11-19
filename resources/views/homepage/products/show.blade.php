<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Details</title>
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
     <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
</head>
<style>
    /* File: resources/assets/css/homepage.css */

    .product_detail_section {
         font-family: Arial, sans-serif;

    }

    .alert {
        margin-top: 1rem;
        text-align: center;
        font-size: 1rem;
        font-weight: bold;
    }



    .btn {
        display: inline-block;
        padding: 0.7rem 1.5rem;
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background-color: #d8af53;
        border: none;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        text-decoration: none;
        text-transform: uppercase;
    }

    .btn:hover {
        background-color: #b4933f;
    }

    .btn-secondary {
        display: flex;
        align-items: center;
        background-color: #444;
    }

    .btn-secondary:hover {
        background-color: #666;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
    }

    .alert-warning {
        background-color: #d8af53;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: #e35c5c;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }

    .alert-success {
        background-color: #4a894c;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }

    a {
        text-decoration: none;
        color: #a0a0a0;
    }

    ul {
        text-align: start;
        margin: 0;
        padding: 0;
    }

    .check_login {
        color: black;
        margin: 4px;

    }

    @media (max-width: 626px) {

        .btn {
            font-size: 12px;
        }



    }

    @media (max-width: 490px) {
        .alert {
            font-size: 10px;
        }
    }

    @media (max-width: 369px) {
        .alert {
            font-size: 7px;
        }
    }

 
</style>

<body>
    @include('homepage.homenav.homenav')

    <section class="product_detail_section">
        <div class="product_detail_container">
            <h1 class="product_name">{!! wrapText($product->name, 30) !!}</h1>
            <div class="product_details">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product_image"
                style="width: 300px; height: 375px; display: block; margin: 10px auto; object-fit: cover;" />
                 <div class="description">
                    <h2>Description:</h2>
                    <p class="product_description  ">{!! wrapText($product->description, 40) !!}</p>
                </div>
            </div>
            <p class="product_price">Price: <span class="price_value">${{ $product->price }}</span> </p>

            <!-- Alert for low stock -->
            @if ($product->quantity <= 0)
                <div class="alert alert-danger"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    This product is out of stock!
                </div>
            @elseif ($product->quantity < 3)
                <div class="alert alert-warning"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    Only {{ $product->quantity }} left in stock! Hurry up!
                </div>
            @endif

            <!-- Display success message if available -->
            @if (session('success'))
                <div class="alert alert-success"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display error message if available -->
            @if (session('error'))
                <div class="alert alert-danger"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Show login message if the user is not logged in -->
            @if (!auth()->check())
                <p class="alert alert-warning"
                    style="height: 40px; margin-top: 17px; display: flex; align-items: center">
                    You need to <a class="check_login" href="{{ route('login') }}"> log in </a> first to place in the
                    cart.
                </p>
            @endif

            <div class="button-container">
                @if (auth()->check())
                    <!-- Check if the product is in stock before displaying the order form -->
                    @if ($product->quantity > 0)
                        <form action="{{ route('orders.store', $product->id) }}" method="POST" class="order_form">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="total_price" value="{{ $product->price }}">
                            <input type="hidden" name="customer_id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-warning">Store Product in Cart</button>
                        </form>
                    @endif
                @endif
                <a href="{{ route('category.products', $product->category->id) }}" class="btn btn-secondary">Back to
                    Category</a>
            </div>

        </div>
    </section>

    <script src="{{ asset('./assets/js/homepage.js') }}"></script>

    @include('homepage.footer.footer')
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
