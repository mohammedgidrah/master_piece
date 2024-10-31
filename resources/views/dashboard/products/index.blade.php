@extends('dashboard.maindasboard')

@section('content')
    <div class="page-inner" style="padding-top: 75px">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-header  ">
            <h3 class="fw-bold mb-3">Products Management</h3>
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
                    <a href="{{ route('products.index') }}">Products</a>
                </li>
            </ul>
        </div>

        <!-- Search and Filter -->
        <div class="mb-3 ">
            <form action="{{ route('products.index') }}" method="GET" class="d-flex justify-content-between">
                <div>
                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                        <option value="{{ $totalProducts }}" {{ request('per_page') == $totalProducts ? 'selected' : '' }}>
                            All</option>
                    </select>
                </div>
                <div>
                    <select name="stock" class="form-control" onchange="this.form.submit()">
                        <option value="">All Stock</option>
                        <option value="in_stock" {{ request('stock') == 'in_stock' ? 'selected' : '' }}>In Stock</option>
                        <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>Out of
                            Stock</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" name="search" placeholder="Search..." class="form-control"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Total Products Display -->
        <div class="mb-3  ">
            <h5>Total Products: {{ $totalProducts }}</h5>
        </div>

        @if ($products->isNotEmpty())
            <div class="table-responsive ">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Quantity</th>
                            <th>Category</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
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
                    </tfoot>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                        style="width: 75px; height: auto; border-radius: 50%;">
                                </td>
                                <td>{!! wrapText($product->name, 30) !!}</td>
                                <td>{!! wrapText($product->description, 30) !!}</td>
                                <td>{{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>

                                <td>
                                    <div class="form-button-action d-flex justify-content-start">
                                        <!-- Edit Icon -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Delete Icon -->
                                        <a href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $product->id }}"
                                            class="btn btn-link btn-danger btn-lg" data-original-title="Delete User">
                                            <i class="fa fa-times"></i>
                                        </a>

                                        <!-- Delete Confirmation Modal -->
                                        <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete <span
                                                            id="productName">{{ $product->name }}</span>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form id="deleteForm{{ $product->id }}" method="POST"
                                                            action="{{ route('products.destroy', $product->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="  d-flex justify-content-between p-4">
                    {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}

                    <div class="  d-flex justify-content-end  ">
                        <a href="{{ route('products.create') }}" class="btn btn-primary me-2">
                            <i class="fa fa-plus"></i> Create Product
                        </a>
                        <a href="{{ route('products.trashed') }}" class="btn btn-danger">
                            <i class="fa fa-trash"></i> View Trashed Products
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center" role="alert">
                No products found.
            </div>
        @endif
    </div>
    @include('dashboard.footer')
</div>

    @php
        if (!function_exists('wrapText')) {
            function wrapText($text, $length = 50)
            {
                return nl2br(wordwrap($text, $length, "\n", true));
            }
        }
    @endphp

@endsection
