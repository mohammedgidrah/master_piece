{{-- @extends('dashboard.maindasboard')

@section('content')
    <main id="main" class="main">
        <div class="col-12">
            <div class="card recent-sales overflow-auto shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Deleted Users</h5>
                    <a href="{{ route('users.index') }}" type="button" class="btn btn-primary">Go Back</a>
                </div>

                <div class="card-body">
                    @if ($deletedUsers->isEmpty())
                        <div class="alert alert-info">No deleted users found.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($deletedUsers as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td class="d-flex flex-wrap gap-2">
                                                <form id="restore-form-{{ $user->id }}"
                                                    action="{{ route('user.restore', $user->id) }}" method="POST"
                                                    class="d-inline-block" style="flex: 1;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button"
                                                        onclick="confirmRestore(event, {{ $user->id }})"
                                                        class="btn btn-success d-flex align-items-center justify-content-center"
                                                        style="flex: 1;">
                                                        <i class="fa-solid fa-undo"></i> Restore
                                                    </button>
                                                </form>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('user.forceDelete', $user->id) }}" method="POST"
                                                    class="d-inline-block" style="flex: 1;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        onclick="confirmDelete(event, {{ $user->id }})"
                                                        class="btn btn-danger d-flex align-items-center justify-content-center"
                                                        style="flex: 1;">
                                                        <i class="fa-solid fa-trash"></i> Delete Permanently
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $deletedUsers->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmRestore(event, userId) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Are you sure?',
                text: "This will restore the user.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, restore it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('restore-form-' + userId).submit();
                }
            });
        }
        function confirmDelete(event, userId) {
            event.preventDefault(); // Prevent the default form submission
            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the user!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            });
        @endif
    </script>
    @endsection --}}