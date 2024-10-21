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
    <style>
        /* Form container styles */
        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding-top: 100px;
            /* background-color: #f8f9fa; */
        }

        .maina {
            /* background-color: #ffffff; */
            border-radius: 10px;
            /* padding-top: 100px; */

            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            border-radius: 5px;
        }

        .login_input:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        /* Button styles */
        .login_btn {
            /* background-color: #007bff; */
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
            background-color: #0056b3;
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
            /* margin-bottom: 20px; */
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
                <form id="login-form" method="POST" action="{{ route('reset.password.post') }}" >
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
                            placeholder="Enter your email" value="{{ old('email') }}" >
                    </div>

                    <!-- New Password Input -->
                    <div class="mb-3">
                        <input type="password" class="login_input" name="password" id="password"
                            placeholder="Enter new password" >
                    </div>

                    <!-- Confirm Password Input -->
                    <div class="mb-3">
                        <input type="password" class="login_input" name="password_confirmation"
                            id="password_confirmation" placeholder="Confirm new password" >
                    </div>

                    <!-- Submit Button -->
                    <button class="login_btn" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
