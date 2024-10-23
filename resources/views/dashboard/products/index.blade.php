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
            <h3 class="fw-bold mb-3">products Management</h3>
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
                    <a href={{ route('products.index') }}>products</a>
                </li>
            </ul>
        </div>

        <!-- Create Button -->


        <!-- Search and Filter -->
        <div class="mb-3">
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
                        <option value="">All stocks</option>
                        <option value="in_stock" {{ request('stock') == 'in_stock' ? 'selected' : '' }}>in stock</option>
                        <option value="out_of_stock" {{ request('stock') == 'out_of_stock' ? 'selected' : '' }}>out of stock</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" name="search" placeholder="Search..." class="form-control"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Total Users Display -->
        <div class="mb-3">
            <h5>Total products: {{ $totalProducts }}</h5>
        </div>

        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th> Name</th>
                        <th>description</th>
                        <th>price</th>
                        <th>stock</th>
                        <th>quantity</th>
                        <th>category</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th> Name</th>
                        <th>description</th>
                        <th>price</th>
                        <th>stock</th>
                        <th>quantity</th>
                        <th>category</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($products->isNotEmpty())
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{-- <img src="{{ $product->image ?? asset('path/to/default/image.png') }}" style="width: 50px; height: auto; border-radius: 50%;"> --}}
                                    <img src="{{ asset('storage/' . $product->image) }}"
                                    style="width: 75px; height: auto;  " />

                                </td>
                                <td>{!! wrapText($product->name, 30) !!} </td>
                                <td>{!! wrapText($product->description, 30) !!}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category ? $product->category->name : 'No Category' }}</td>

                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);"
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();"
                                            class="btn btn-link btn-danger btn-lg" data-original-title="Delete User">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form id="delete-form-{{ $product->id }}"
                                            action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    @endif
                </tbody>

            </table>
            <div class="mb-3 d-flex justify-content-end" >
                <a href="{{ route('products.create') }}" class="btn btn-primary me-2">
                    <i class="fa fa-plus"></i> Create product
                </a>
                <a href="{{ route('products.trashed') }}" class="btn btn-danger">
                    <i class="fa fa-trash"></i> View Trashed products
                </a>
            </div>
            <!-- Pagination Controls -->
            <div class="mt-3 d-flex justify-content-start">
                {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
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
