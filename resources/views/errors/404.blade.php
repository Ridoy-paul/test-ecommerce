<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>404 Page Not Found</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container-fluid {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }
        .error-code {
            font-size: 150px;
            font-weight: bold;
        }
        .error-message {
            font-size: 1.25rem;
            color: #6c757d;
        }
        .text-danger {
            color: #dc3545 !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row w-100">
            <div class="col-md-12">
                <div class="text-center mt-1">
                    <span class="error-code">404</span>
                    <h1>Page Not Found</h1>
                    <p class="error-message">Sorry, the page you are looking for could not be found.</p>
                    <span class="text-danger">{{ $exception->getMessage() }}</span>
                    <div class="mt-4">
                        <a href="/" class="btn btn-primary">Go to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta3/js/bootstrap.min.js"></script>
</body>
</html>
