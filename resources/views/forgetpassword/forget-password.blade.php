<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}">
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />
    <!-- Social Media and Open Graph Tags -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />

    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="assets/img/home/masterpeace_logo-removebg-preview.png" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>

</head>

<body>
    @include('homepage.homenav.homenav')

    <div class="wrapper" style="display: flex; justify-content: center; align-items: center; height: 550px">

        <div class="main" style="width: 500px">
            <div class="logins">
                <p style="color: white ; font-size: 20px; display: flex; justify-content: center;  text-align: center">we wil send you a link to reset your password please enter your email</p>
                <form id="login-form" method="POST" action="{{ route('forget.password.post') }} "
                    class=" ">
                    @csrf
                    <label for="chk" aria-hidden="true" style="font-size: 30px"> please enter your email</label>

                    <!-- Email Input -->
                    <input class="login_input" type="email" name="email" id="email-input-login" placeholder="Email"
                        value="{{ old('email') }}">
                    <!-- Error message for email -->
                    <p id="email_error" class="error"></p>



                    <button class="login_btn" type="submit">submit</button>
                </form>

            </div>

        </div>
    </div>
    @include('homepage.footer.footer')
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

</body>

</html>
