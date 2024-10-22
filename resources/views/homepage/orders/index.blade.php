{{-- <!DOCTYPE html>
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

  --}}
{{-- <!DOCTYPE html>
  <html lang="en">
  
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Shopping Cart</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
      <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
      <link rel="icon" type="image/png" href="../assets/img/home/masterpeace_logo-removebg-preview.png" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  </head>
  
  <body style="height: 100vh">
    @include('homepage.homenav.homenav')
    <div style="padding-top: 100px">

        <div class="container mt-5 " style="background-color: white;">
            <h2 class="text-start mb-4">Shopping Cart</h2>
    
            @if ($orders->isEmpty())
                <div class="alert alert-info text-center">
                    Your cart is empty. <a href="{{ route('home') }}">Continue shopping</a>
                </div>
            @else
                     <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                  <th style="display: flex; align-items: center; justify-content: center; width: auto;" colspan="2">Product</th>
                                  <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th></th>
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
                                        <td >
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $order->product->image) }}"
                                                     class="img-fluid" style="width: 80px; height: auto; margin-right: 10px;">
                                                {{ $order->product->name }}
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle">${{ number_format($order->product->price, 2) }}</td>
                                        <td style="vertical-align: middle">
                                            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $order->quantity }}" min="1" class="form-control" style="width: 80px; display:inline-block;">
                                                <button type="submit" class="btn btn-link" data-original-title="Update Quantity">
                                                    <i class="fa fa-sync-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td style="vertical-align: middle">${{ number_format($subtotal, 2) }}</td>
                                        <td style="vertical-align: middle">
                                            <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();" class="btn btn-link btn-lg" data-original-title="Delete User">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
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
  
  </html> --}}
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
  
              <!-- Cart Table -->
              <div class="table-responsive">
                  <table class="table cart-table">
                      <thead>
                          <tr>
                              <th style="display: flex; align-items: center; justify-content: center; width: auto;" colspan="2">Product</th>
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
                                      <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" style="width: 80px; height: auto; margin-right: 10px;">
                                      {{ $order->product->name }}
                                  </td>
                                  <td style="vertical-align: middle">
                                      {{ $order->product->price }}
                                  </td>
                                  <td style="vertical-align: middle">
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" class="form-control" value="{{ $order->quantity }}" style="width: 60px;" min="1" onchange="this.form.submit()">
                                    </form>
                                </td>
                                
                                  <td style="vertical-align: middle">${{ number_format($subtotal, 2) }}</td>
                                  <td style="vertical-align: middle">
                                      <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();" class="btn btn-link btn-lg" data-original-title="Delete User">
                                          <i class="fa fa-times"></i>
                                      </a>
                                      <form id="delete-form-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display: none;">
                                          @csrf
                                          @method('DELETE')
                                      </form>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
  
              <!-- Coupon and Cart Update -->
              {{-- <div class="cart-actions d-flex justify-content-end pb-4">
                  <button class="btn btn-primary">UPDATE CART</button>
              </div> --}}
              <div class="row">
                  <div class="col-md-4 ml-auto">
                      <div class="border p-4">
                          <h5>Cart totals</h5>
                          <ul class="list-unstyled">
                              <li class="d-flex justify-content-between">
                                  <span>Total:</span>
                                  <span>${{ number_format($total, 2) }}</span>
                              </li>
                          </ul>
                          <button class="btn btn-primary btn-block">PROCEED TO CHECKOUT</button>
                      </div>
                  </div>
              </div>
  
          </div>
      </div>
  
      <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </body>
  
  </html>
  


  