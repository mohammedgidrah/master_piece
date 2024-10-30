@extends('dashboard.maindasboard')

@section('content')

<div class="page-inner ps-3  " style="padding-top: 75px">
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <div class="page-header" style="padding-top: 75px">
        <h3 class="fw-bold mb-3">Trashed products</h3>
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
                <a href={{ route('products.index') }}>Back to products</a>
            </li>
        </ul>
    </div>
</div>


    <!-- Success Message -->

    <div class="table-responsive">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     style="width: 75px; height: auto;">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->category ? $product->category->name : 'No category' }}</td>
                            <td>
                                <button class="btn btn-success" onclick="showRestoreModal({{ $product->id }})">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button class="btn btn-danger" onclick="showDeleteModal({{ $product->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Restore Confirmation Modal -->
                        <div class="modal fade" id="restoreModal{{ $product->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="restoreModalLabel{{ $product->id }}">Restore Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to restore this product?</p>
                                        <p class="text-muted">Restoring this product will make it available for sale again.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('products.restore', $product->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restore</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Confirmation Modal -->
                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $product->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $product->id }}">Delete Product</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete this product? This action cannot be undone.</p>
                                        <p class="text-muted">Once deleted, you will not be able to recover this product.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('products.forceDelete', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center">
                            No trashed products found. (back to <a href="{{ route('products.index') }}">products</a>)
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-start">
            {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
    @include('dashboard.footer')
</div>

    <script>
        function showRestoreModal(productId) {
            const modal = new bootstrap.Modal(document.getElementById('restoreModal' + productId));
            modal.show();
        }

        function showDeleteModal(productId) {
            const modal = new bootstrap.Modal(document.getElementById('deleteModal' + productId));
            modal.show();
        }
    </script>
@endsection
