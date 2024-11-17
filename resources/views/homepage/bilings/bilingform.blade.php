<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopping Cart & Billing Information</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />
</head>
<style>
    .main {
        background: #242424;
        padding: 50px;
    }

    #billing_form {
        padding: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
    }
    #billing_header{
        color: rgb(179, 162, 51);
    }
    label{
        color: rgb(179, 162, 51)
    }
    #btn {
        background-color: rgb(179, 162, 51);
        color: white;
        border: none;
        outline: none;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
    }
    @media  (max-width: 380px) {
        #btn {
            font-size: 10px;
        }
        
    }
    .form-control{
        background-color: #EEEEEE
    }

    footer {
        background-color: ;
        margin-top: 50px
    }
</style>

<body>
    @include('homepage.homenav.homenav')

    <div class="main">


        <div class="container mt-5" id="billing_form">
            <h2 class="mb-4" id="billing_header"> Billing Information</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Billing form -->
            <form action="{{ route('checkout.store', ['orderId' => $order->id]) }}" method="POST">
                @csrf

                <input type="hidden" name="order_id" value="{{ $order->id }}">
                <input type="hidden" name="user_id" value="{{ $user->id }}"> <!-- Using the user ID -->

                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your first name.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your last name.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter a valid email.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your phone number.
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="billing_city" class="form-label">Billing City:</label>
                        <input type="text" name="billing_city" id="billing_city" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your billing city.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="billing_address" class="form-label">Billing Address:</label>
                        <input type="text" name="billing_address" id="billing_address" class="form-control" required>
                        <div class="invalid-feedback">
                            Please enter your billing address.
                        </div>
                    </div>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" id="btn" class="btn btn-primary">Submit Billing Information</button>
                </div>
            </form>

        </div>


    </div>
    @include('homepage.footer.footer')

    <script src="{{ asset('assets/js/homepage.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> --}}
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script>
        // Bootstrap validation for the billing form
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>
