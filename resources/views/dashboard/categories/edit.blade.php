@extends('../dashboard.maindasboard')

@section('content')
    {{-- <div class="page-inner" > --}}
        <div class="page-inner d-flex justify-content-start align-items-start" style="padding-top:  75px">
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
                    <a href={{ route('categories.index') }}>categories</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href={{ route('categories.edit', $category->id) }}>Edit categories</a>
                </li>
            </ul>
        </div>

        <div class="row"  style="padding:  10px   10px">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT for update -->

                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">description</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $category->description }}">
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

 
 
 

 
 
 
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage(event)">
                                <div class="d-flex align-items-center mt-2">
                                    <p class="mb-0">Old image:</p>
                                    @if ($category->image)
                                        <!-- Display Old Image -->
                                        <img src="{{ asset('storage/' . $category->image) }}"
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
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.footer')
    </div>

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
