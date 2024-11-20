<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <meta name="description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta name="keywords" content="handmade jewelry, gemstones, rare gemstones, exclusive collection, jewelry craftsmanship" />
    <meta name="author" content="MASA Jewelry" />
    <!-- Social Media and Open Graph Tags -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg-preview.png') }}" />

    <meta property="og:title" content="Handcrafted Gemstone Jewelry - MASA" />
    <meta property="og:description" content="Discover exclusive collections of handmade jewelry featuring rare gemstones, each with unique beauty and storytelling charm." />
    <meta property="og:image" content="assets/img/home/masterpeace_logo-removebg-preview.png" />
    <meta property="og:url" content="{{ url('/') }}" />
    <meta name="twitter:card" content="summary_large_image" />    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
    <style>
        .error_text {
            color: white;
            font-size: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        .main {
            display: flex;
            padding: 50px;
            background: #242424;
            flex-direction: column;
            justify-content: center;
            align-items: center;
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
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Include Homepage Navigation -->
    @include('homepage.homenav.homenav')

    <div class="main">
        <div class="unauthorized mx-auto" data-text="404">
            <h1 class="font-weight-bold display-1 animated text-white">404</h1>
        </div>
        <p class="error_text">Sorry, the page you are looking for could not be found.</p>
        <p>
            <a href="{{ url('/') }}" id="btn" class="btn btn-warning">
                <i class="fa-solid fa-arrow-left" style="color: #ffffff;"></i> Return to Home
            </a>
        </p>
    </div>

    <!-- Include Homepage Footer -->
    @include('homepage.footer.footer')

    <script src="{{ asset('assets/js/homepage.js') }}"></script>
    <script src="https://kit.fontawesome.com/a49038f582.js"></script>
</body>

</html>
