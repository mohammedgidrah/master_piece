@extends('dashboard.maindasboard')

@section('content')
<div class="page-inner" style="padding-top: 75px">
    <h3 class="fw-bold mb-3">Edit Order</h3>
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
            <a href="{{ route('ordersdash.index') }}">Orders</a>
        </li>
        <li class="separator">
            <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
            <a href="{{ route('ordersdash.edit', $order->id) }}">Edit Order</a>
        </li>
    </ul>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ordersdash.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="user">Select User</label>
                            <select class="form-control" id="user" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $order->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product">Product Name</label>
                            <input type="text" class="form-control" id="product" name="product_name" value="{{ $order->product->name }}">
                            @error('product_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" id="description" name="product_description">{{ $order->product->description }}</textarea>
                            @error('product_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price">Total Price</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $order->product->price }}">
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="order_status">Order Status</label>
                            <select class="form-control" id="order_status" name="order_status">
                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                            @error('order_status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="form-group mt-3">
                            <label for="image">Order Image</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)">
                            <img id="imagePreview" src="{{ asset('storage/' . $order->product->image) }}" style="width: 100px; height: auto; margin-top: 10px;">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div> --}}

                        <button type="submit" class="btn btn-primary mt-3">Update Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('dashboard.footer')

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
