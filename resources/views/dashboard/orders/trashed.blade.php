@extends('dashboard.maindasboard')

@section('content')

<div   style="padding-top: 75px" >

    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
</div>
<div class="page-inner ps-3 d-flex justify-content-start align-items-start  "    >
        <h3 class="fw-bold mb-3">Trashed orders</h3>

        <!-- Display Success Message -->

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

    <div class="table-responsive p-4">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price per Item</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->isNotEmpty())
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>
                                @if ($order->product && $order->product->image)
                                    <img src="{{ asset('storage/' . $order->product->image) }}"
                                        style="width: 75px; height: auto;">
                                @else
                                    <img src="{{ asset('path/to/placeholder.jpg') }}" style="width: 75px; height: auto;"
                                        alt="No Image">
                                @endif
                            </td>
                            <td>{!! wrapText($order->user->first_name, 30) !!} {!! wrapText($order->user->last_name, 30) !!}</td>
                            <td>{!! wrapText($order->product->name, 30) !!}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->product->price }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>{{ $order->order_status }}</td>
                            <td>
                                <button class="btn btn-success m-1" onclick="showRestoreModal({{ $order->id }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button class="btn btn-danger m-1" onclick="showDeleteModal({{ $order->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" class="text-center">
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

    <!-- Restore Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Restore Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to restore this order? It will become active again.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="restore-form" action="" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this order? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="delete-form" action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.footer');
    </div>


    <script>
        function showRestoreModal(orderId) {
            document.getElementById('restore-form').action = '{{ route('ordersdash.restore', '') }}' + '/' + orderId;
            var restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            restoreModal.show();
        }

        function showDeleteModal(orderId) {
            document.getElementById('delete-form').action = '{{ route('ordersdash.forceDelete', '') }}' + '/' + orderId;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endsection
