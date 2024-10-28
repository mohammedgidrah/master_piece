@extends('dashboard.maindasboard')

@section('content')
<div class="container">
    <h2>Order Details for Order #{{ $order->id }}</h2>

    <h3>Products in this Order:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price per Unit</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($order->Allproducts as $product) <!-- Changed from Allproducts to products -->
            <tr>    
                <td>{{ $product->name }}</td> <!-- Make sure you are using the correct field names -->
                <td>{{ $product->description }}</td> <!-- Same here -->
                <td>${{ number_format($product->pivot->price_per_unit, 2) }}</td>
                <td>{{ $product->pivot->quantity }}</td>
                <td>${{ number_format($product->pivot->total_price, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No products found in this order.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <h4>Total Order Amount: ${{ number_format($order->items->sum(fn($item) => $item->total_price), 2) }}</h4> <!-- Adjusting to use total_price from pivot table -->
</div>
@endsection

{{-- @extends('dashboard.maindasboard')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
</head>
<body>
    <h1>Order Details</h1>
    <h2>Products in Order</h2>
    <ul>
        @foreach ($order->Allproducts as $product)
            <li>
                <h3>{{ $product->name }}</h3>
                <p>Description: {{ $product->description }}</p>
                <p>Price per Unit: ${{ $product->pivot->price_per_unit }}</p>
                <p>Quantity: {{ $product->pivot->quantity }}</p>
                <p>Total Price: ${{ $product->pivot->total_price }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>
@endsection --}}