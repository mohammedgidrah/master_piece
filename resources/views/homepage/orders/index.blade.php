<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="../assets/img/home/masterpeace_logo-removebg-preview.png" />
</head>

<body style="height: 100vh">
    @include('homepage.homenav.homenav')
    <div style="padding-top: 100px">

        <div class="container mt-5" style="background-color: white;">
            <h1 class="mb-4">Cart</h1>

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

            <!-- Check if there are no products in the cart -->
            @if ($orders->isEmpty())
                <div class="alert alert-info text-center">
                    Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
                </div>
            @else
                <!-- Cart Table -->
                <div class="table-responsive">
                    <table class="table cart-table">
                        <thead>
                            <tr>
                                <th style="display: flex; align-items: center; justify-content: center; width: auto;"
                                    colspan="2">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($orders as $order)
                                @php
                                    $subtotal = $order->product->price * $order->quantity;
                                    $total += $subtotal;
                                @endphp
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $order->product->image) }}"
                                            alt="{{ $order->product->name }}"
                                            style="width: 80px; height: auto; margin-right: 10px;">
                                        {{ $order->product->name }}
                                    </td>
                                    <td style="vertical-align: middle">
                                        {{ $order->product->price }}
                                    </td>
                                    <td style="vertical-align: middle">
                                        <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" class="form-control"
                                                value="{{ $order->quantity }}" style="width: 60px;" min="1"
                                                onchange="this.form.submit()">
                                        </form>
                                    </td>

                                    <td style="vertical-align: middle">${{ number_format($subtotal, 2) }}</td>
                                    <td style="vertical-align: middle">
                                        <a href="javascript:void(0);"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();"
                                            class="btn btn-link btn-lg" data-original-title="Delete User">
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
                            <button class="btn btn-primary btn-block">PROCEED TO CHECKOUT</button>
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
