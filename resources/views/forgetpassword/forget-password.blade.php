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
    <style>
        .error {
            color: red;
            font-size: 12px;
        }
    </style>

</head>

<body>
    @include('homepage.homenav.homenav')

    <div class="wrapper">

        <div class="main ms-auto me-auto mt-5" style="width: 500px">
            <div class="logins">
                <p style="color: WHITE">we wil send you a link to reset your password</p>
                <form id="login-form" method="POST" action="{{ route('forget.password.post') }} "
                    class="ms-auto me-auto mt-5">
                    @csrf
                    <label for="chk" aria-hidden="true" style="font-size: 30px">forget password</label>

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
</body>

</html>
