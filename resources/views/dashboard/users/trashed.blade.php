@extends('dashboard.maindasboard')

@section('content')
    <div class="page-inner" style="padding-top: 75px">
         <div class="page-header">
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

        <div class="table-responsive">
            <table class="display table table-striped table-hover">
                <thead>
                    <tr>
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
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('users.restore', $user->id) }}" method="POST" class="d-inline" id="restore-form-{{ $user->id }}">
                                        @csrf
                                        <button type="button" class="btn btn-success" onclick="confirmRestore({{ $user->id }})">Restore</button>
                                    </form>
                                    <form action="{{ route('users.forceDelete', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Delete Permanently</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center">No trashed users found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-start">
                {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>

    <script>
        function confirmRestore(userId) {
            swal({
                title: "Are you sure?",
                text: "Once restored, this user will be active again!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willRestore) => {
                if (willRestore) {
                    document.getElementById('restore-form-' + userId).submit();
                }
            });
        }

        function confirmDelete(userId) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, this user cannot be restored!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
@endsection
