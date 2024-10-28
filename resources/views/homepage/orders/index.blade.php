<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />
</head>

<body style="height: 100vh">
    @include('homepage.homenav.homenav')

    <div style="padding-top: 100px">
        <div class="container mt-5" style="background-color: white;">
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
                    {{ session('success') }} <!-- Display the success message -->
                </div>
            @endif

            <!-- Search Form -->
            <form method="GET" action="{{ route('orders.index') }}" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search product..."
                        value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Search</button>
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
                                <th colspan="2" style="text-align: center;">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"></th>
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
                                            style="width: 80px; height: auto; margin-right: 10px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" class="form-control"
                                                value="{{ $order->quantity }}" style="width: 60px;" min="1"
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
                        <div class="border p-4">
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
                            <!-- Checkout Button -->
                            <a href="{{ route('billing.create', ['orderId' => $order->id, 'productId' => $product->id]) }}"
                                class="btn btn-primary btn-block">
                                Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
