<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MASA</title>
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    <style>

    /* Basic dropdown styling */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        background-color: transparent;
        color: #d8af53;
        padding: 10px;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        color: #4a098b box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a,
    .dropdown-content form button {
        color: #d8af53;
        padding: 12px 30px;
        text-decoration: none;
        display: block;
        background: none;
        border: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .dropdown-content a:hover,
    .dropdown-content form button:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-divider {
        height: 1px;
        margin: .5rem 0;
        overflow: hidden;
        background-color: #e9ecef;
    }
</style>
</style>

<body>
 
@include('homepage.homenav.homenav')
    <div class="wrapper">
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <!-- Sign-Up Form -->
            <div class="sign-in-contaner">
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Include CSRF token for form security -->
                    <label class="sign_up" for="chk" aria-hidden="true">SIGN UP</label>

                    <!-- First Name -->
                    <input type="text" name="first_name" placeholder="First name" required>

                    <!-- Last Name -->
                    <input type="text" name="last_name" placeholder="Last name" required>

                    <!-- Email -->
                    <input type="email" name="email" placeholder="Email" required>

                    <!-- Password -->
                    <input type="password" name="password" placeholder="Password" required>

                    <!-- Submit Button -->
                    <button class="sign_up_btn" type="submit">SIGN UP</button>

                    <p class="sign_in_p">or sign up with</p>

                    <!-- Social Media Signup Icons -->
                    <div class="svg_contaner">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#ffffff"
                                d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                            <path fill="#ffffff"
                                d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="#ffffff"
                                d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z" />
                        </svg>
                    </div>
                </form>
            </div>

            <!-- Login Form -->
            <div class="login">
                <form method="POST" action="{{ route('login.submit') }}">
                    @csrf
                    <label for="chk" aria-hidden="true">Login</label>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <a class="forget_password" href="#">Forget password?</a>
                    <button class="login_btn" type="submit">Login</button>
                    <p>or login with</p>

                    <div class="svg_contaner">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 488 512">
                            <path
                                d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path
                                d="M459.4 151.7c.3 4.5 .3 9.1 .3 13.6 0 138.7-105.6 298.6-298.6 298.6-59.5 0-114.7-17.2-161.1-47.1 8.4 1 16.6 1.3 25.3 1.3 49.1 0 94.2-16.6 130.3-44.8-46.1-1-84.8-31.2-98.1-72.8 6.5 1 13 1.6 19.8 1.6 9.4 0 18.8-1.3 27.6-3.6-48.1-9.7-84.1-52-84.1-103v-1.3c14 7.8 30.2 12.7 47.4 13.3-28.3-18.8-46.8-51-46.8-87.4 0-19.5 5.2-37.4 14.3-53 51.7 63.7 129.3 105.3 216.4 109.8-1.6-7.8-2.6-15.9-2.6-24 0-57.8 46.8-104.9 104.9-104.9 30.2 0 57.5 12.7 76.7 33.1 23.7-4.5 46.5-13.3 66.6-25.3-7.8 24.4-24.4 44.8-46.1 57.8 21.1-2.3 41.6-8.1 60.4-16.2-14.3 20.8-32.2 39.3-52.6 54.3z" />
                        </svg>
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
</body>

</html>
