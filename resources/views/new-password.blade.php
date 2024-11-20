<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}">
    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />
    <!-- Social Media and Open Graph Tags -->
    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="assets/img/home/masterpeace_logo-removebg-preview.png " />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />


    <style>
        /* Form container styles */
        * {
            font-family:    serif;

        }
        .wrapper {
            
            display: flex;
            justify-content: center;
            align-items: center;

            /* background-color: #f8f9fa; */
        }

        .maina {
            border-radius: 10px;


            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            padding: 30px;
            width: 100%;
            max-width: 500px;
        }

        /* Form label and input styles */
        .form-label {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .login_input {
            width: 100%;
            padding: 10px;
            margin-top: 30px;
            margin-bottom: 15px;
            border: 1px solid #ced4da;
            background: #EEEEEE;
            border-radius: 5px;
        }

        .login_input:focus {
            border-color: #d7b053;
            outline: none;
             box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Button styles */
        .login_btn {
            background-color: #d7b053;
            color: white;
            border: none;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 12px 20px;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .login_btn:hover {
            background-color: #8f7a48;
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 12px;
        }

        /* Title styling */
        .form-title {
            font-size: 24px;
            font-weight: bold;
             text-align: center;
            color: white;
        }

        label {
            font-size: 14px;
            /* color: #333; */
            margin-bottom: 10px;
            /* display: block; */
            font-weight: bold;
        }
    </style>

</head>

<body>
    @include('homepage.homenav.homenav')

    <div class="wrapper">
        <div class="maina">
            <div class="logins">
                <form id="login-form" method="POST" action="{{ route('reset.password.post') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-title">Reset Password</div>

                    @if ($errors->any())
                        <div class="alert alert-danger" style="color: red">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Email Input -->
                    <div class="mb-3">
                        <input type="email" class="login_input" name="email" id="email"
                            placeholder="Enter your email" value="{{ old('email') }}">
                    </div>

                    <!-- New Password Input -->
                    <div class="mb-3">
                        <input type="password" class="login_input" name="password" id="password"
                            placeholder="Enter new password">
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-3">
                        <input type="password" class="login_input" name="password_confirmation"
                            id="password_confirmation" placeholder="Confirm new password">
                    </div>

                    <!-- Submit Button -->
                    <button class="login_btn" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
    @include('homepage.footer.footer')
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
