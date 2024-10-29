@extends('dashboard.maindasboard')

@section('content')

    <div class="page-inner d-flex justify-content-start align-items-start" style="padding-top: 75px">
        <h3 class="fw-bold mb-3">Trashed orders</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href={{ route('dashboard.maindasboard') }}>
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href={{ route('ordersdash.index') }}>Back to orders</a>
            </li>
        </ul>
    </div>

    <div class="table-responsive">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th> <!-- Added Quantity column -->
                    <th>Price per Item</th> <!-- Added Price per Item column -->
                    <th>Total Price</th> <!-- Total Price is already included -->
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                @if ($order->product && $order->product->image)
                                    <img src="{{ asset('storage/' . $order->product->image) }}" style="width: 75px; height: auto;">
                                @else
                                    <img src="{{ asset('path/to/placeholder.jpg') }}" style="width: 75px; height: auto;" alt="No Image">
                                @endif
                            </td>
                            <td>{!! wrapText($order->user->first_name, 30) !!} {!! wrapText($order->user->last_name, 30) !!}</td>
                            <td>{!! wrapText($order->product->name, 30) !!}</td>
                            <td>{{ $order->quantity }}</td> <!-- Display Quantity -->
                            <td>{{ $order->product->price }}</td> <!-- Price per Item -->
                            <td>{{ $order->total_price }}</td> <!-- Total Price -->
                            <td>{{ $order->order_status }}</td>
                            <td>
                                <form action="{{ route('ordersdash.restore', $order->id) }}" method="POST" class="d-inline" id="restore-form-{{ $order->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-success" onclick="confirmRestore({{ $order->id }})">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                <form action="{{ route('ordersdash.forceDelete', $order->id) }}" method="POST" class="d-inline" id="delete-form-{{ $order->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $order->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">
                            No trashed products found. (back to <a href="{{ route('ordersdash.index') }}">orders</a>)
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-start">
            {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <script>
        function confirmRestore(productId) {
            swal({
                    title: "Are you sure?",
                    text: "Once restored, this order will be active again!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willRestore) => {
                    if (willRestore) {
                        document.getElementById('restore-form-' + productId).submit();
                    }
                });
        }

        function confirmDelete(productId) {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, this order cannot be restored!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        document.getElementById('delete-form-' + productId).submit();
                    }
                });
        }
    </script>
@endsection
