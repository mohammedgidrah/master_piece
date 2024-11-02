<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unauthorized Access - 403</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/homepage.css" />
    <style>
        body {
            background: linear-gradient(to bottom, #0f0c29, #302b63, #24243e);
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }
        .text-white {
            color: #fff !important;
        }
    </style>
</head>

<body>
@include('homepage.homenav.homenav')
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="text-center">
            <div class="unauthorized mx-auto" data-text="403">
                <h1 class="font-weight-bold display-1 animated text-white">403</h1>
            </div>
            <p class="lead text-white mb-4">Access Denied</p>
            <p class="text-white mb-4">
                Oops! It seems you do not have permission to view this page.
            </p>
            <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                &larr; Back to Home
            </a>
        </div>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
