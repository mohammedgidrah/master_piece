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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<style>
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        border-radius: 50%;
        padding: 20px;
    }
 

    .carousel-control-prev-icon {
        background-image: url('https://cdn-icons-png.flaticon.com/512/860/860790.png');
        background-size: cover;
    }

    .carousel-control-next-icon {
        background-image: url('https://cdn-icons-png.flaticon.com/512/860/860790.png');
        background-size: cover;
        transform: rotate(180deg);
    }
</style>

<body style="height: 100vh">
    @include('homepage.homenav.homenav') <!-- Include your navbar -->

    <div class="container mt-4" style="padding-top: 150px">
        <h2 class="text-start mb-4" style="color: white">Your Orders</h2>

        @if ($orders->isEmpty())
            <div class="alert alert-info text-center">You have no orders yet. Back to <a href="{{ route('home') }}">home</a></div>
        @else
            <div id="ordersCarousel" class="carousel slide"  >
                <div class="carousel-inner">
                    @foreach ($orders as $index => $order)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <div class="card" style="margin-bottom: 20px">
                                <div class="card-header">
                                    Order Number #{{ $order->id }}
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $order->product->image) }}" alt="Order Image" class="img-fluid"  style="width: 200px; height: auto;">
                                    <p class="order-info"><strong>Status:</strong> {{ ucfirst($order->order_status) }}</p>
                                    <p class="order-info"><strong>Total Price:</strong> ${{ $order->total_price }}</p>
                                    <p class="order-info"><strong>Date:</strong> {{ $order->created_at->format('Y-m-d') }}</p>

                                    <!-- Delete Order Button -->
                                    <button type="button" class="btn btn-danger delete-order" data-id="{{ $order->id }}">Delete</button>
                                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                @if ($orders->count() > 1) <!-- Show arrows only if more than one order -->
                    <a class="carousel-control-prev" href="#ordersCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#ordersCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
                @endif
            </div>
        @endif
    </div>

    <script src="../assets/js/homepage.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Event listener for the delete button
            $('.delete-order').on('click', function() {
                const orderId = $(this).data('id'); // Get the order ID
                const form = $(this).next('form'); // Get the associated form

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form to delete the order
                        form.submit();
                    }
                });
            });
        });
    </script>
</body>

</html>
