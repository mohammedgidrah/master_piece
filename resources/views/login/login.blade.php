<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASA</title>
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="assets/css/login.css">
    <style>
        .error {
            color: red;
            font-size: 12px;
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
                    <p class="error"
                        style="display: flex; align-items: center; justify-content: center; font-size: 12px">
                        {{ $errors->first('email') }}</p>
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

                    <input class="sign_up_input" type="text" id="firstName-input-sign-up" name="first_name"
                        placeholder="First name">
                    <p id="fname-error" class="error"></p>

                    <input class="sign_up_input" type="text" id="lastName-input-sign-up" name="last_name"
                        placeholder="Last name">
                    <p id="lname-error" class="error"></p>

                    <input class="sign_up_input" type="email" id="email-input-sign-up" name="email"
                        placeholder="Email">
                    <p id="email-error" class="error"></p>

                    <input class="sign_up_input" type="password" id="password-input-sign-up" name="password"
                        placeholder="Password">
                    <p id="password-error" class="error"></p>

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
                <form id="login-form" method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <label for="chk" aria-hidden="true">Login</label>

                    <!-- Email Input -->
                    <input class="login_input" type="email" name="email" id="email-input-login" placeholder="Email">
                    <!-- Error message for email -->
                    <p id="email_error" class="error"></p>

                    <!-- Password Input -->
                    <input class="login_input" type="password" name="password" id="password-input-login"
                        placeholder="Password">
                    <!-- Error message for password -->
                    <p id="password_error" class="error"></p>

                    <a class="forget_password" href="{{ route('forget.password') }}">Forget password?</a>
                    <button class="login_btn" type="submit">Login</button>
                </form>

            </div>

        </div>
    </div>
    <footer>
        <div style="display: flex; align-items: center; justify-content: center">
            <p>&copy;2023 All rights reserved | This template is made with <span style="color: red "> ❤</span> by Masa
            </p>
        </div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission behavior
    
            // Clear previous error messages
            document.getElementById('email_error').innerHTML = '';
            document.getElementById('password_error').innerHTML = '';
    
            // Collect form data
            const formData = new FormData(this);
    
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (!response.ok) {
                    // Parse the HTML response
                    return response.text().then(text => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
    
                        // Extract validation error messages
                        const emailError = doc.querySelector('p#error-email')?.textContent || 'Invalid email or password.';
                        const passwordError = doc.querySelector('p#error-password')?.textContent || 'Invalid email or password.';
    
                        // Display the errors
                        document.getElementById('email_error').innerHTML = emailError;
                        document.getElementById('password_error').innerHTML = passwordError;
                    });
                } else {
                    window.location.href = '/'; // Redirect to home or intended page on success
                }
            }).catch(error => {
                console.error('Error:', error);
            });
        });
    </script> --}}


    <script src="{{ asset('assets/js/login.js') }}"></script>
    <script src="{{ asset('assets/js/homepage.js') }}"></script>

</body>

</html>
