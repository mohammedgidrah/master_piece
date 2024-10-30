@extends('dashboard.maindasboard')

@section('content')
<div class="page-inner " style="padding-top: 75px">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="page-header d-flex justify-content-start align-items-start"  >
            <h3 class="fw-bold mb-3">Trashed Users</h3>
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
                    <a href={{ route('users.index') }}>Back to Users</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="table-responsive" style="padding: 10px 10px">
        <table class="display table table-striped table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($users->isNotEmpty())
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/' . $user->image) }}" style="width: 100px; height: auto; border-radius: 50%;">
                            </td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $user->id }}">
                                    <i class="fas fa-undo"></i>
                                </button>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Restore Modal --}}
                        <div class="modal fade" id="restoreModal{{ $user->id }}" tabindex="-1" aria-labelledby="restoreModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="restoreModalLabel{{ $user->id }}">Restore User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to restore this user? Once restored, this user will be active again!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline" id="restore-form-{{ $user->id }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success">Restore</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete this user? Once deleted, this user cannot be restored!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}">
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
                        <td colspan="5" class="text-center">
                            No trashed users found. (back to <a href="{{ route('users.index') }}">users</a>)
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <div class="mt-3 d-flex justify-content-start">
            {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
