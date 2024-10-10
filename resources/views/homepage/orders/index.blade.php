<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Your Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="../assets/img/home/masterpeace_logo-removebg-preview.png" />

    </style>
</head>

<body style="100vh">
    @include('homepage.homenav.homenav') <!-- Include your navbar -->

    <div class="container mt-4" style="padding-top: 150px">
        <h2 class="text-start mb-4" style="color: white">Your Orders</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">You have no orders yet.</div>
        @else
            @foreach ($orders as $order)
                <div class="card" style="margin-bottom: 20px">
                    <div class="card-header">
                        Order Number #{{ $order->id }}
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $order->product->image) }}" alt="Order Image">
                        <p class="order-info"><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                        <p class="order-info"><strong>Total Price:</strong> ${{ $order->total_price }}</p>
                        <p class="order-info"><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            {{-- <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    {{ $orders->links() }} <!-- This generates the pagination links -->
                </ul>
            </nav> --}}
        @endif
    </div>
    <script src="{{ asset('./assets/js/homepage.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
