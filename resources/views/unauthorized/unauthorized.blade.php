<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access - 403</title>
    <!-- Bootstrap CSS -->
    <link rel="icon" type="image/png" href="assets/img/home/masterpeace_logo-removebg-preview.png" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />


    <style>
        .text-center {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            background: #242424;
            padding: 50px;
        }

        .text-white {
            color: #fff !important;
        }

        #btn {
            background-color: rgb(179, 162, 51);
            color: white;
            border: none;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            outline: none;
            width: 150px;
            height: 50px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
 
         }
    </style>
</head>

<body>
    @include('homepage.homenav.homenav')
    <div class=" main">
        <div class="text-center">
            <div class="unauthorized mx-auto" data-text="403">
                <h1 class="font-weight-bold display-1 animated text-white">403</h1>
            </div>
            <p class="lead text-white mb-4">Access Denied</p>
            <p class="text-white mb-4">
                Oops! It seems you do not have permission to view this page.
            </p>
            <a href="{{ route('home') }}" id="btn" class="btn btn-warning btn-lg">
                <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i> Back to Home
            </a>
        </div>
    </div>
    @include('homepage.footer.footer')

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a49038f582.js" ></script>

</body>

</html>
