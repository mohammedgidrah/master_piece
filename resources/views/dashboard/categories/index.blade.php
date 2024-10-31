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
            <div class="alert alert-danger alert-dismissible fade show bg-light mt-5" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-header" style="padding-top: 50px">
            <h3 class="fw-bold mb-3">Categories Management</h3>
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
                    <a href="{{ route('categories.index') }}">Categories</a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="mb-3 ps-4">
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

    <!-- Total Categories Display -->
    <div class="mb-3 ps-4">
        <h5>Total categories: {{ $totalcategories }}</h5>
    </div>

    <div class="table-responsive p-3"  style="border-radius: 50px">
        @if ($categories->isNotEmpty())
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
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $category->image) }}" style="width: 75px; height: auto; border-radius: 50%;" />
                            </td>
                            <td>{!! wrapText($category->name, 30) !!}</td>
                            <td>{!! wrapText($category->description, 30) !!}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-link btn-primary btn-lg" data-original-title="Edit User">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="showDeleteModal('{{ $category->id }}');" class="btn btn-link btn-danger btn-lg" data-original-title="Delete User">
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
                </tbody>
            </table>
        @else
            <div class="alert alert-warning mb-0 text-center" role="alert">
                No categories found.
            </div>
        @endif
    </div>

    <!-- Pagination Controls -->
    <div class="d-flex justify-content-between align-items-center  p-4  ">
        {{-- <div class="d-flex justify-content-center align-items-center"> --}}

            {{ $categories->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        {{-- </div> --}}
        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('categories.create') }}" class="btn btn-primary me-2 d-flex align-items-center ">
                <i class="fa fa-plus"></i> Create Category
            </a>
            <a href="{{ route('categories.trashed') }}" class="btn btn-danger d-flex align-items-center">
                <i class="fa fa-trash"></i> View Trashed Categories
            </a>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
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

    <script>
        let deleteCategoryId;

        function showDeleteModal(categoryId) {
            deleteCategoryId = categoryId;
            var myModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            myModal.show();
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            document.getElementById('delete-form-' + deleteCategoryId).submit();
        });
    </script>

@endsection
