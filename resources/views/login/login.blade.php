<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASA</title>
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="assets/css/login.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
         .error {
            color: red;
            font-size: 12px;
        }

        .user-box {
            position: relative;
        }

        .password-toggle-icon {
            position: absolute;
            top: 50%;
            right: 78px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .password-toggle-icon i {
            font-size: 18px;
            color: white;
            transition: color 0.3s ease;
        }

 

        @media (max-width: 768px) {
            .password-toggle-icon {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                cursor: pointer;
            }

            .password-toggle-icon i {
                font-size: 20px;
                color: #999;
                transition: color 0.3s ease;
            }

 

            .user-box {
                position: relative;

            }

            .password-toggle-icon {
                position: absolute;
                top: 50%;
                right: 10px;
                transform: translateY(-50%);
                cursor: pointer;
            }


 

        }
    </style>
</head>

<body style="height: 100vh">

    @include('homepage.homenav.homenav')

    <div class="wrapper">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <!-- Sign-Up Form -->
            <div class="sign-in-contaner">
                @if ($errors->has('email'))
                    <p class="error">{{ $errors->first('email') }}</p>
                @endif
                @if ($errors->has('password'))
                    <p class="error">{{ $errors->first('password') }}</p>
                @endif
                @if ($errors->any())
                    <p class="success">{{ $errors->first() }}</p>
                @endif

                <form id="sign-up-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="sign_up" for="chk" aria-hidden="true">SIGN UP</label>

                    <input class="sign_up_input" type="text" id="firstName-input-sign-up" name="first_name" placeholder="First name">
                    <p id="fname-error" class="error"></p>

                    <input class="sign_up_input" type="text" id="lastName-input-sign-up" name="last_name" placeholder="Last name">
                    <p id="lname-error" class="error"></p>

                    <input class="sign_up_input" type="email" id="email-input-sign-up" name="email" placeholder="Email">
                    <p id="email-error" class="error"></p>

                    <div class="user-box">
                        <input class="sign_up_input" type="password" id="password-input-sign-up" name="password" placeholder="Password">
                        <span onclick="togglePasswordVisibility('password-input-sign-up', this)" class="password-toggle-icon">
                            <i class="fa-solid fa-eye" id="toggle-password"></i>
                         </span>
                    </div>
                    <p id="password-error" class="error"></p>

                    <button class="sign_up_btn" type="submit">SIGN UP</button>
                    <p class="sign_up_p">or sign up with</p>
                    <div class="svg_contaner">
                        <!-- SVG icons here -->
                    </div>
                </form>
            </div>

            <!-- Login Form -->
            <div class="login">
                <form id="login-form" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <label for="chk" aria-hidden="true">Login</label>

                    <input class="login_input" type="email" name="email" id="email-input-login" placeholder="Email">
                    <p id="email_error" class="error"></p>

                    <div class="user-box">
                        <input class="login_input" type="password" id="password-input-login" name="password" placeholder="Password">
                        <span onclick="togglePasswordVisibility('password-input-login', this)" class="password-toggle-icon">
                            <i class="fas fa-eye" id="toggle-password" style="color: black"></i>
                        </span>
                    </div>
                    <p id="password_error" class="error"></p>

                    <a class="forget_password" href="{{ route('forget.password') }}">Forget password?</a>
                    <button class="login_btn" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div style="display: flex; align-items: center; justify-content: center">
            <p>&copy;2023 All rights reserved | This template is made with <span style="color: red "> ❤</span> by Masa</p>
        </div>
    </footer>

    <script>
        function togglePasswordVisibility(inputId, icon) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            icon.querySelector('i').classList.toggle('fa-eye-slash');
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

</body>

</html>
