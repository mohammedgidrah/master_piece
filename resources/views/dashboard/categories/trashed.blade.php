@extends('dashboard.maindasboard')

@section('content')
<div class="page-inner " style="padding-top: 100px">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-light" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="page-header">
        <h3 class="fw-bold mb-3">Trashed categories</h3>
        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href={{ route('dashboard.maindasboard') }}>
                    <i class="icon-home"></i>
                </a>
            </li>
            <li class="separator" style="width: 10px">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href={{ route('categories.index') }}>Back to categories</a>
            </li>
        </ul>
    </div>

    <div class="table-responsive" style="padding: 10px 10px">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($categories->isNotEmpty())
                    @foreach ($categories as $category)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $category->image) }}" style="width: 100px; height: auto; border-radius: 50%;">
                            </td>
                            <td>{!! wrapText($category->name, 30) !!}</td>
                            <td>{!! wrapText($category->description, 30) !!}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $category->id }}">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <!-- Restore Confirmation Modal -->
                                <div class="modal fade" id="restoreModal{{ $category->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="restoreModalLabel{{ $category->id }}">Restore Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to restore this category?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('categories.restore', $category->id) }}" method="POST" id="restore-form-{{ $category->id }}">
                                                    @csrf
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success" onclick="event.preventDefault(); document.getElementById('restore-form-{{ $category->id }}').submit();">Restore</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Delete Category</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this category? This action cannot be undone.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('categories.forceDelete', $category->id) }}" method="POST" id="delete-form-{{ $category->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $category->id }}').submit();">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">
                            No trashed categories found. (back to <a href="{{ route('categories.index') }}">categories</a>)
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-start">
            {{ $categories->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
        @include('dashboard.footer')
    </div>
</div>
@endsection
