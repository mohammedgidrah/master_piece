<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASA</title>
    <link rel="stylesheet" href="assets/css/login.css">

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />
    <!-- Social Media and Open Graph Tags -->
    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />
</head>
 

<body>

    @include('homepage.homenav.homenav')

    <div class="wrapper">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="sign-in-contaner">
                @if ($errors->has('email'))
                    <p class="error" style="display: flex; justify-content: center; align-items: center">
                        {{ $errors->first('email') }}</p>
                @endif
                @if ($errors->has('password'))
                    <p class="error" style="display: flex; justify-content: center; align-items: center">
                        {{ $errors->first('password') }}</p>
                @endif
                @if ($errors->any())
                    <p class="success">{{ $errors->first() }}</p>
                @endif

                <form id="sign-up-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="sign_up" for="chk" aria-hidden="true">SIGN UP</label>

                    <input class="sign_up_input" type="text" id="firstName-input-sign-up" name="first_name"
                        placeholder="First name">
                    <p id="fname-error" class="error"></p>

                    <input class="sign_up_input" type="text" id="lastName-input-sign-up" name="last_name"
                        placeholder="Last name">
                    <p id="lname-error" class="error"></p>

                    <input class="sign_up_input" type="email" id="email-input-sign-up" name="email"
                        placeholder="Email">
                    <p id="email-error" class="error"></p>

                    <div class="user-box">
                        <input class="sign_up_input" type="password" id="password-input-sign-up" name="password"
                            placeholder="Password">
                        <span onclick="togglePasswordVisibility('password-input-sign-up', this)"
                            class="password-toggle-icon">
                            <i class="fa-solid fa-eye" id="toggle-password"></i>
                        </span>
                    </div>
                    <p id="password-error" class="error"></p>

                    <button class="sign_up_btn" type="submit">SIGN UP</button>
                    <p class="sign_up_p">or sign up with</p>
                    <div class="svg_contaner">
                        <a href="/auth/google" class="social-btn google-btn">
                            <i class="fab fa-google"></i> Google
                        </a>


                    </div>

                </form>
            </div>

            <div class="login">
                <form id="login-form" class="login-form" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <label class="login_text" for="chk" aria-hidden="true">Login</label>

                    <input class="login_input" type="email" name="email" id="email-input-login" placeholder="Email">
                    <p id="email_error" class="error"></p>

                    <div class="user-box">
                        <input class="login_input" type="password" id="password-input-login" name="password"
                            placeholder="Password">
                        <span onclick="togglePasswordVisibility('password-input-login', this)"
                            class="password-toggle-icon">
                            <i class="fas fa-eye" id="toggle-password"  ></i>
                        </span>
                    </div>
                    <p id="password_error" class="error"></p>

                    <a class="forget_password" href="{{ route('forget.password') }}">Forget password?</a>
                    <button class="login_btn" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
    @include('homepage.footer.footer')



    <script>

    </script>
    <script src="https://kit.fontawesome.com/a49038f582.js"  ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

</body>

</html>
