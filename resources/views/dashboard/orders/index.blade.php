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
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href="{{ route('ordersdash.index') }}">Orders</a>
            </li>
        </ul>
    </div>

    <!-- Create Button -->


    <!-- Search and Filter -->
    <div class="mb-3">
        <form action="{{ route('ordersdash.index') }}" method="GET" class="d-flex justify-content-between">
            <div>
                <select name="per_page" class="form-control" onchange="this.form.submit()">
                    <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                    <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                    <option value="{{ $totalorders }}" {{ request('per_page') == $totalorders ? 'selected' : '' }}>
                        All
                    </option>
                </select>
            </div>
            <div>
                <select name="order_status" class="form-control" onchange="this.form.submit()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('order_status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="shipped" {{ request('order_status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ request('order_status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <div class="d-flex align-items-center">
                <input type="text" name="search" placeholder="Search..." class="form-control" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </div>
        </form>
    </div>

    <!-- Total Orders Display -->
    <div class="mb-3">
        <h5>Total Orders: {{ $totalorders }}</h5>
    </div>

    <div class="table-responsive">
        <table id="add-row" class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
            <tbody>
                @if ($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $order->product->image) }}" style="width: 75px; height: auto;">
                            </td>
                            <td>{!! wrapText($order->user->first_name, 30) !!} {!! wrapText($order->user->last_name, 30) !!}</td>
                            <td>{!! wrapText($order->product->name, 30) !!}</td>
                            <td>{{ $order->product->price }}</td>
                            
                            <td>
                                <form action="{{ route('ordersdash.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select style="background-color: rgb(0 0 0 / 5%)" name="order_status" class="form-control" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option style="    background-color: #31ce36; " value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            
                            <td>
                                <div class="form-button-action">
 
                                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $order->id }}').submit();" class="btn btn-link btn-danger btn-lg" data-original-title="Delete Order">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <form id="delete-form-{{ $order->id }}" action="{{ route('ordersdash.destroy', $order->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">No orders found.</td>
                    </tr>
                @endif
            </tbody>
            
        </table>

        <!-- Pagination Controls -->
        <div class="mt-3 d-flex justify-content-start">
            {{ $orders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    <div class="mb-3 d-flex justify-content-end">
        <a href="{{ route('ordersdash.trashed') }}" class="btn btn-danger">
            <i class="fa fa-trash"></i> View Trashed Orders
        </a>
    </div>
</div>
@include('dashboard.footer')
</div>

@php
if (!function_exists('wrapText')) {
    function wrapText($text, $length = 50) {
        return nl2br(wordwrap($text, $length, "\n", true));
    }
}
@endphp

@endsection
