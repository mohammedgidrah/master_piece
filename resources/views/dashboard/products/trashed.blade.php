@extends('dashboard.maindasboard')

@section('content')
 
    {{-- <div class="main-panel" style="padding-top: 75px"> --}}
    <div class="page-inner d-flex  justify-content-start align-items-start" style="padding-top: 75px" >
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

    <div class="table-responsive">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
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
                                style="width: 75px; height: auto;  ">
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>
                                <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline"
                                    id="restore-form-{{ $product->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-success"
                                        onclick="confirmRestore({{ $product->id }})">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                <form action="{{ route('products.forceDelete', $product->id) }}" method="POST"
                                    class="d-inline" id="delete-form-{{ $product->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete({{ $product->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">
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
    </div>
    </div>


    <script>
        function confirmRestore(productId) {
            swal({
                    title: "Are you sure?",
                    text: "Once restored, this product will be active again!",
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
                    text: "Once deleted, this product cannot be restored!",
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
