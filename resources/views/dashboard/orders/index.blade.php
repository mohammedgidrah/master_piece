@extends('dashboard.maindasboard')

@section('content')
    <div class="page-inner" style="padding-top: 100px">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show bg-light" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-header">
            <h3 class="fw-bold mb-3">Order Management</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard.maindasboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Search Form and Filters -->
    <div class="mb-3 ps-4">
        <form action="{{ route('ordersdash.index') }}" method="GET"
            class="d-flex justify-content-between align-items-center">
            <div>
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                    <option value="{{ $totalOrders }}" {{ request('per_page') == $totalOrders ? 'selected' : '' }}>All
                    </option>
                </select>
            </div>

            <div>
                <select name="order_status" class="form-control mx-2" onchange="this.form.submit()">
                    <option value="">All Statuses</option>
                    @foreach (['pending', 'processing', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('order_status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <input type="text" name="search" placeholder="Search..." class="form-control"
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <div class="mb-3 ps-4">
        <h5>Total orders: {{ $totalOrders }}</h5>
    </div>

    <div class="table-responsive ps-4">
        @if ($orders->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No orders found.
            </div>
        @else
            <table id="add-row" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->groupBy('order_id') as $orderGroup)
                        @php
                            $firstOrder = $orderGroup->first();
                            $totalPrice = $orderGroup->sum(
                                fn($order) => $order->product?->price * $order->quantity ?? 0,
                            );
                        @endphp
                        <tr>
                            <td class="d-flex align-items-center">
                                @if ($firstOrder->user)
                                    <img src="{{ asset('storage/' . $firstOrder->user->image) }}"
                                        alt="{{ $firstOrder->user->first_name }} {{ $firstOrder->user->last_name }}"
                                        style="width: 85px; height: 85px; border-radius: 50%;" /> 
                                    <span style="margin-left: 20px;">   {{ $firstOrder->user->first_name }} {{ $firstOrder->user->last_name }}</span>
                                @else
                                    <img src="{{ asset('images/default-user.png') }}" alt="Default User"
                                        style="width: 85px; height: 85px; border-radius: 50%;" />
                                    <span>N/A</span>
                                @endif
                            </td>

                            <td>${{ number_format($totalPrice, 2) }}</td>
                            <td>
                                <form action="{{ route('ordersdash.update', $firstOrder->order_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select id="order-row-{{ $firstOrder->id }}" name="order_status" class="form-control"
                                        onchange="this.form.submit()">
                                        @foreach (['pending', 'processing', 'delivered', 'cancelled'] as $status)
                                            <option value="{{ $status }}"
                                                {{ $firstOrder->order_status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>{{ $firstOrder->created_at->format('Y-m-d') }}</td>

                            <td>
                                <div class="form-button-action">
                                    <button type="button" class="btn btn-link btn-info btn-lg" data-bs-toggle="modal"
                                        data-bs-target="#orderModal{{ $firstOrder->id }}" title="View Products">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal for displaying products in the order -->
                        <div class="modal fade" id="orderModal{{ $firstOrder->id }}" tabindex="-1"
                            aria-labelledby="orderModalLabel{{ $firstOrder->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="orderModalLabel{{ $firstOrder->id }}">Order Products
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($orderGroup as $order)
                                                <li class="d-flex align-items-center mb-2">
                                                    <img src="{{ isset($order->product->image) ? asset('storage/' . $order->product->image) : asset('images/default-product.png') }}"
                                                        alt="{{ $order->product?->name ?? 'N/A' }}"
                                                        style="width: 75px; height: 75px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
                                                    <span>{{ $order->product?->name ?? 'N/A' }} :
                                                        ${{ number_format($order->product?->price ?? 0, 2) }} x
                                                        {{ $order->quantity }} =
                                                        ${{ number_format(($order->product?->price ?? 0) * $order->quantity, 2) }}</span>

                                                    <form id="delete-product-form-{{ $order->id }}"
                                                        action="{{ route('ordersdash.deleteProduct', $order->id) }}"
                                                        method="POST" class="ms-2" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#" class="text-danger" title="Delete Product"
                                                            onclick="event.preventDefault(); document.getElementById('delete-product-form-{{ $order->id }}').submit();">
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </a>
                                                    </form>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Inside the modal for each order group -->
                                    <div class="modal-footer">
                                        <form id="delete-order-form-{{ $firstOrder->order_id }}"
                                            action="{{ route('ordersdash.destroy', $firstOrder->order_id) }}"
                                            method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger"
                                                onclick="event.preventDefault(); document.getElementById('delete-order-form-{{ $firstOrder->order_id }}').submit();">
                                                Delete all Orders
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="mt-3 d-flex justify-content-between">
                {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        @endif
        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('ordersdash.trashed') }}" class="btn btn-danger">
                <i class="fa fa-trash"></i> View Trashed Orders
            </a>
        </div>
    </div>
    @include('dashboard.footer')
    </div>
    </div>

    <script>
        function updateOrderStatus(selectElement, orderId) {
            // Select the row using the data-order-id attribute
            const row = document.querySelector(`tr[data-order-id="${orderId}"]`);
            const selectedStatus = selectElement.value;

            // Change the background color based on the selected status
            switch (selectedStatus) {
                case 'pending':
                    row.style.backgroundColor = 'lightblue'; // Light blue for pending
                    break;
                case 'processing':
                    row.style.backgroundColor = 'lightyellow'; // Light yellow for processing
                    break;
                case 'delivered':
                    row.style.backgroundColor = 'lightgreen'; // Light green for delivered
                    break;
                case 'cancelled':
                    row.style.backgroundColor = 'lightcoral'; // Light coral for cancelled
                    break;
                default:
                    row.style.backgroundColor = ''; // Reset to default
            }
        }
    </script>


@endsection
