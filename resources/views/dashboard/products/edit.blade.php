@extends('../dashboard.maindasboard')

@section('content')
    {{-- <div class="main-panel " > --}}
    <div class="page-inner" style="padding-top: 75px">
        <h3 class="fw-bold mb-3  ">Edit Product</h3>
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
                <a href={{ route('products.index') }}>Products</a>
            </li>
            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>
            <li class="nav-item">
                <a href={{ route('products.edit', $product->id) }}>Edit Product</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Use PUT for update -->

                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $product->name }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                                @error('description')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="stock">Stock Status</label>
                                <select class="form-control" id="stock" name="stock">
                                    <option value="in_stock" {{ $product->stock == 'in_stock' ? 'selected' : '' }}>In
                                        Stock
                                    </option>
                                    <option value="out_of_stock" {{ $product->stock == 'out_of_stock' ? 'selected' : '' }}>
                                        Out
                                        of Stock</option>
                                </select>
                                @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-control" id="category" name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="image">Product Image</label>
                                <input type="file" class="form-control-file" id="image" name="image"
                                    onchange="previewImage(event)">
                                <div class="d-flex align-items-center mt-2">
                                    <p class="mb-0">Old image:</p>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                            style="width: 100px; height: auto;" class="img-thumbnail ms-2" id="oldImage" />
                                            @else
                                            <p class="mb-0 ms-3">(No image)</p>
                                    @endif
                                    <p class="mb-0 ms-3">New image:</p>
                                    <img id="newImagePreview" style="width: 100px; height: auto; display: none;"
                                        class="img-thumbnail ms-2" />
                                </div>

                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Product</button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
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
