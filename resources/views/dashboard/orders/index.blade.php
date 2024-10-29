@extends('dashboard.maindasboard')

@section('content')
    <div class="page-inner" style="padding-top: 100px">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show bg-light" role="alert">
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

        <!-- Search Form and Filters -->
        <div class="mb-3">
            <form action="{{ route('ordersdash.index') }}" method="GET" class="d-flex justify-content-between">
                <div>
                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                        <option value="{{ $totalOrders }}" {{ request('per_page') == $totalOrders ? 'selected' : '' }}>All</option>
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


 

        <div class="mb-3">
            <h5>Total orders: {{ $totalOrders }}</h5>
        </div>

        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Total Price</th>
                        <th>Order Status</th>
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
                                        style="width: 50px; height: auto; border-radius: 50%;" />
                                    <span>{{ $firstOrder->user->first_name }} {{ $firstOrder->user->last_name }}</span>
                                @else
                                    <img src="{{ asset('images/default-user.png') }}" alt="Default User"
                                        style="width: 50px; height: auto; border-radius: 50%;" />
                                    <span>N/A</span>
                                @endif
                            </td>

                            <td>${{ number_format($totalPrice, 2) }}</td>
                            <td>
                                <form action="{{ route('ordersdash.update', $firstOrder->order_id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="order_status" class="form-control" onchange="this.form.submit()">
                                        @foreach (['pending', 'processing', 'delivered', 'cancelled'] as $status)
                                            <option value="{{ $status }}"
                                                {{ $firstOrder->order_status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>

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
                                        <h5 class="modal-title" id="orderModalLabel{{ $firstOrder->id }}">Order Products</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach ($orderGroup as $order)
                                                <li class="d-flex align-items-center mb-2">
                                                    <img src="{{ isset($order->product->image) ? asset('storage/' . $order->product->image) : asset('images/default-product.png') }}"
                                                         alt="{{ $order->product?->name ?? 'N/A' }}"
                                                         style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                    <span>{{ $order->product?->name ?? 'N/A' }} :
                                                        ${{ number_format($order->product?->price ?? 0, 2) }} x
                                                        {{ $order->quantity }} =
                                                        ${{ number_format(($order->product?->price ?? 0) * $order->quantity, 2) }}</span>

                                                             <div class="form-button-action">
 
                                                                <a href="javascript:void(0);"
                                                                    onclick="event.preventDefault(); document.getElementById('delete-form-{{ $firstOrder->id }}').submit();"
                                                                    class="btn btn-link btn-danger btn-lg" title="Delete Order">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                                <form id="delete-form-{{ $firstOrder->id }}"
                                                                    action="{{ route('ordersdash.destroy', $firstOrder->id) }}" method="POST"
                                                                    style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </div>
                                                        </td>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="mt-3 d-flex justify-content-start">
                {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <a href="{{ route('ordersdash.trashed') }}" class="btn btn-danger">
                    <i class="fa fa-trash"></i> View Trashed orders
                </a>
            </div>
        </div>
    </div>

    @include('dashboard.footer')
</div>
@endsection
