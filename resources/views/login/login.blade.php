<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASA</title>
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        /* Basic dropdown styling */


        /* Error message styling */
        .error {
            color: red;
            font-size: 12px;
        }
    </style>
</head>

<body>

    @include('homepage.homenav.homenav')
    <div class="wrapper">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <!-- Sign-Up Form -->
            <div class="sign-in-contaner">
                <form id="sign-up-form" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Include CSRF token for form security -->
                    <label class="sign_up" for="chk" aria-hidden="true">SIGN UP</label>

                    <!-- First Name -->
                    <input class="sign_up_input" type="text" id="firstName-input-sign-up" name="first_name" placeholder="First name" >
                    <p id="fname-error"   class="error"></p>

                    <!-- Last Name -->
                    <input class="sign_up_input" type="text" id="lastName-input-sign-up" name="last_name" placeholder="Last name" >
                    <p id="lname-error" class="error"></p>

                    <!-- Email -->
                    <input class="sign_up_input" type="email" id="email-input-sign-up" name="email" placeholder="Email" >
                    <p  id="email-error" class="error"></p>

                    <!-- Password -->
                    <input class="sign_up_input" type="password" id="password-input-sign-up" name="password" placeholder="Password" >
                    <p id="password-error" class="error"></p>

                    <!-- Submit Button -->
                    <button class="sign_up_btn" type="submit">SIGN UP</button>

                    <p class="sign_up_p">or sign up with</p>

                    <!-- Social Media Signup Icons -->
                    <div class="svg_contaner">
                        <!-- SVG icons here -->
                    </div>
                </form>
            </div>

            <!-- Login Form -->
            <div class="login">
                <form id="login-form" method="POST" action="{{ route('login.submit') }}" onsubmit="return validateLogin()">
                    @csrf
                    <label for="chk" aria-hidden="true">Login</label>
                    <input class="login_input" type="email" name="email" placeholder="Email"  pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="Please enter a valid email address">
                    <input class="login_input" type="password" name="password" placeholder="Password"  minlength="8" title="Password must be at least 8 characters long">
                    <a class="forget_password" href="#">Forget password?</a>
                    <button class="login_btn" type="submit">Login</button>
                    <p class="sign_in_p">or login with</p>

                    <div class="svg_contaner">
                        <!-- SVG icons here -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="foter_content">
            <p>&copy;2023 All rights reserved | This template is made with ❤ by Masa</p>
        </div>
    </footer>



    <script src="assets/js/homepage.js"></script>
    <script src="assets/js/login.js"></script>
</body>

</html>
