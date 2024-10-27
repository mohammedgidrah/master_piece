<!-- resources/views/order/success.blade.php -->
{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h1>Thank You!</h1>
        <p>Your order has been placed successfully.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
    </div>
</div>
{{-- @endsection --}}
