<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />

    <style>
        /* Page Layout */
        #btn {
            background-color: #a8741a;
            color: white;
            border: none;
            outline: none;
            width: 150px;
            height: 40px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .containers {
            background-color: #3e3e3e;
            padding: 25px
        }

        h1 {
            font-size: 2rem;
             color: white;
         }

        /* Alerts */
        .alert-success {
        background-color: #4a894c;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }

    .alert-danger {
        background-color: #ff6666;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }
        .alert {
            margin-top: 10px;
            border-radius: 5px;
        }

        /* Search Form */
        .input-group {
            max-width: 400px;
            margin-bottom: 20px;
        }

        /* Cart Table */
        .cart-table {
            text-align: center;
        }

        .cart-table th {
            color: #333;
            font-weight: bold;
        }

        .cart-table td {
            vertical-align: middle;
        }

        .cart-table img {
            border-radius: 4px;
        }

        .form-control {
            display: inline-block;
            width: auto;
        }

        /* Quantity Input */
        input[type="number"] {
            text-align: center;
            max-width: 60px;
        }

        /* Remove Button */
        .btn-link {
            color: #dc3545;
        }

        .btn-link:hover {
            color: #bd2130;
        }

        /* Cart Totals Section */
        .cart-totals {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .cart-totals h5 {
            font-weight: bold;
            color: #333;
        }

        .cart-totals .list-unstyled li {
            padding: 10px 0;
            font-weight: 500;
            color: #555;
        }

        /* Checkout Button */
        .btn-warning.btn-block {
            font-size: 1.1rem;
            background-color: #a8741a;
            color: white;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    @include('homepage.homenav.homenav')

    <div class="containers">
        <div>
            <h1 class="mb-4">Cart</h1>

            <!-- Error Handling -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search Form -->
            <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search product..."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button id="btn" class="btn btn-warning" type="submit">Search</button>
                    </div>
                </div>
            </form>

            <!-- Cart Content -->
            @if (isset($orders) && $orders->isEmpty())
                <div class="alert alert-info text-center">
                    Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
                </div>
            @elseif (isset($orders))
                <!-- Cart Table -->
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach ($orders as $order)
                                @php
                                    $product = $order->product;
                                    $subtotal = $product->price * $order->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 80px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" class="form-control"
                                                value="{{ $order->quantity }}" min="1"
                                                onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td>${{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <a href="javascript:void(0);"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();"
                                            class="btn btn-link btn-lg">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form id="delete-form-{{ $order->id }}"
                                            action="{{ route('orders.destroy', $order->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Cart Totals -->
                <div class="row">
                    <div class="col-md-4 ml-auto">
                        <div class="cart-totals">
                            <h5>Cart totals</h5>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between">
                                    <span>Subtotal:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </li>
                                <li class="d-flex justify-content-between">
                                    <span>Total:</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </li>
                            </ul>
                            <a href="{{ route('billing.create', ['orderId' => $order->id, 'productId' => $product->id]) }}"
                                class="btn btn-warning btn-block">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @include('homepage.footer.footer')
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
