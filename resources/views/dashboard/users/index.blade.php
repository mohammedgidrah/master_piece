@extends('dashboard.maindasboard')

@section('content')
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
            <h3 class="fw-bold mb-3">User Management</h3>
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
                    <a href={{ route('users.index') }}>Users</a>
                </li>
            </ul>
        </div>

        <div class="mb-3">
            <form action="{{ route('users.index') }}" method="GET" class="d-flex justify-content-between">
                <div>
                    <select name="per_page" class="form-control" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                        <option value="15" {{ request('per_page') == '15' ? 'selected' : '' }}>15</option>
                        <option value="{{ $totalUsers }}" {{ request('per_page') == $totalUsers ? 'selected' : '' }}>All
                        </option>
                    </select>
                </div>
                <div>
                    <select name="role" class="form-control" onchange="this.form.submit()">
                        <option value="">All Roles</option>
                        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <input type="text" name="search" placeholder="Search..." class="form-control"
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <div class="mb-3">
            <h5>Total Users: {{ $totalUsers }}</h5>
        </div>

        <div class="table-responsive">
            <table id="add-row" class="display table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Image</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($users->isNotEmpty())
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $user->image) }}"
                                        alt="{{ $user->first_name }} {{ $user->last_name }}"
                                        style="width: 50px; height: auto; border-radius: 50%;" />
                                </td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="form-button-action d-flex justify-content-start">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-link btn-primary btn-lg" data-original-title="Edit User">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if ($user->role !== 'admin')
                                            <a href="javascript:void(0);"
                                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();"
                                                class="btn btn-link btn-danger btn-lg" data-original-title="Delete User">
                                                <i class="fa fa-times"></i>
                                            </a>
                                            <form id="delete-form-{{ $user->id }}"
                                                action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No users found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-3 d-flex justify-content-start">
                {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('users.create') }}" class="btn btn-primary me-2">
                <i class="fa fa-plus"></i> Create User
            </a>
            <a href="{{ route('users.trashed') }}" class="btn btn-danger">
                <i class="fa fa-trash"></i> View Trashed Users
            </a>
        </div>
    </div>
    @include('dashboard.footer')
    </div>

@endsection
