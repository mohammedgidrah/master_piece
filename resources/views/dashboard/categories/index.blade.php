@extends('dashboard.maindasboard')

@section('content')
{{-- <div class="container"> --}}
    <div class="page-inner" style="padding-top: 75px">

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
            <h3 class="fw-bold mb-3">Categories Management</h3>
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
                    <a href={{ route('categories.index') }}>Categories</a>
                </li>
            </ul>
        </div>

        <!-- Create Button -->
        <div class="mb-3">
            <a href="{{ route('categories.create') }}" class="btn btn-primary">
                <i class="fa fa-plus"></i> Create User
            </a>
        </div>

        <!-- Search and Filter -->
        <div class="mb-3">
            <form action="{{ route('categories.index') }}" method="GET" class="d-flex justify-content-between">
                <div>
                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                        <option value="{{ $totalcategories }}" {{ request('per_page') == $totalcategories ? 'selected' : '' }}>All</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" name="search" placeholder="Search..." class="form-control" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <!-- Total Users Display -->
        <div class="mb-3">
            <h5>Total categories: {{ $totalcategories }}</h5>
        </div>

        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($categories->isNotEmpty())
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $category->image) }}" style="width: 50px; height: auto; border-radius: 50%;" />
                                </td>
                                <td> {!! wrapText($category->name, 30) !!} </td>
                                <td>{!! wrapText($category->description, 30) !!}</td> <!-- Use wrapText function here -->
                                <td>
                                    <div class="form-button-action">
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-link btn-primary btn-lg" data-original-title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();" class="btn btn-link btn-danger btn-lg" data-original-title="Delete User">
                                            <i class="fa fa-times"></i>
                                        </a>
                                        <form id="delete-form-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No category found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <!-- Pagination Controls -->
            <div class="mt-3 d-flex justify-content-start">
                {{ $categories->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        
    </div>
    @include('dashboard.footer')
</div>

@php
function wrapText($text, $length = 50) {
    return nl2br(wordwrap($text, $length, "\n", true));
}
@endphp

@endsection
