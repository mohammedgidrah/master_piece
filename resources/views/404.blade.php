<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/homepage.css" />

    <style>
        /* body {
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            text-align: center;
            padding: 50px;
            font-family: Arial, sans-serif;
        } */

        h1 {
            color: white;
            font-size: 50px;
        }

        p {
            color: white;
            font-size: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>

<body>
    @include('homepage.homenav.homenav')
    <div class="container">

        <div class="unauthorized mx-auto" data-text="404">
            <h1 class="font-weight-bold display-1 animated text-white">404</h1>
        </div>
        <p>Sorry, the page you are looking for could not be found.</p>
        <p><a href="{{ url('/') }}" class="btn btn-primary btn-lg">Return to Home</a></p>
    </div>
</body>

</html>
