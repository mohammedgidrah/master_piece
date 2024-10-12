@extends('dashboard.maindasboard')

@section('content')
<div class="page-inner  d-flex justify-content-start align-items-start" style="padding-top: 100px">
    {{-- <div class="page-inner"> --}}
        <div class="page-header" >
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
    </div>
      
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show bg-light" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive" style="padding:  10px   10px">
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
                                <img src="{{ asset('storage/' . $category->image) }}"
                                    style="width: 100px; height: auto; border-radius: 50%;">
                            </td>
                            <td>{!! wrapText($category->name, 30) !!} </td>
                            <td>{!! wrapText($category->description, 30) !!}</td>


                            <td>
                                <form action="{{ route('categories.restore', $category->id) }}" method="POST"
                                    class="d-inline" id="restore-form-{{ $category->id }}">
                                    @csrf
                                    <button type="button" class="btn btn-success"
                                        onclick="confirmRestore({{ $category->id }})">
                                        <i class="fas fa-undo"></i>
                                    </button>
                                </form>
                                <form action="{{ route('categories.forceDelete', $category->id) }}" method="POST"
                                    class="d-inline" id="delete-form-{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger"
                                        onclick="confirmDelete({{ $category->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
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
    </div>
    
    

    <script>
        function confirmRestore(productId) {
            swal({
                    title: "Are you sure?",
                    text: "Once restored, this category will be active again!",
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
                    text: "Once deleted, this category cannot be restored!",
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
