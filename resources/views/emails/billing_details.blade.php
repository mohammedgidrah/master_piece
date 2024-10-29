<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Billing Details</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <h2>Billing Details</h2>
    <p>Name: {{ $billing->first_name }} {{ $billing->last_name }}</p>
    <p>Email: {{ $billing->email }}</p>
    <p>Phone: {{ $billing->phone }}</p>
    <p>City: {{ $billing->billing_city }}</p>
    <p>Address: {{ $billing->billing_address }}</p>

    <h2>Your Order Items</h2>
    <ul>
        @foreach ($orderItems as $order)
            <li>
                {{ $order->product->name }} - ${{ number_format($order->product->price, 2) }} x {{ $order->quantity }}
            </li>
        @endforeach
    </ul>

    <p>Thank you for shopping with us!</p>
</body>
</html>
