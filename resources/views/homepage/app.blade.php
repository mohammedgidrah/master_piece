<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Default Title')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/homepage.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/home/masterpeace_logo-removebg_preview.png') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    @include('homepage.homenav.homenav')
    @include('homepage.herosectione.herosection')
    @include('homepage.category.category')
 
    <script src="{{ asset('assets/js/homepage.js') }}"></script>
    <script src="https://kit.fontawesome.com/a49038f582.js" crossorigin="anonymous"></script>
</body>

</html>
