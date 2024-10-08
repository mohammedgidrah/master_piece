@extends('../dashboard.maindasboard')

@section('content')
    <div class="page-inner" style="padding-top: 75px">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit User</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Users</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Edit User</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT for update -->

                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $users->first_name }}">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $users->last_name }}">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $users->phone }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="3">{{ $users->address }}</textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="user" {{ $users->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                                <div class="d-flex align-items-center mt-2">
                                    <p class="mb-0">Old image:</p>
                                    @if ($users->image)
                                        <!-- Display Old Image -->
                                        <img src="{{ asset('storage/' . $users->image) }}"
                                             alt="{{ $users->first_name }} {{ $users->last_name }}"
                                             style="width: 100px; height: auto;" class="img-thumbnail ms-2" id="oldImage" />
                                    @endif
                                    <p class="mb-0 ms-3">New image:</p>
                                    <!-- Display New Image Preview -->
                                    <img id="newImagePreview" style="width: 100px; height: auto; display: none;"
                                         class="img-thumbnail ms-2" />
                                </div>

                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.footer')

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('newImagePreview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the new image
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
