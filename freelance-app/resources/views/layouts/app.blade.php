<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Freelance Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('listings.index') }}">
            Freelance Hub
        </a>

        <div class="d-flex">
            <a href="{{ route('listings.create') }}" class="btn btn-primary btn-sm">
                Add Listing
            </a>
        </div>
    </div>
</nav>

<main class="container mb-5">

    @yield('content')

</main>

<footer class="bg-white border-top py-3">
    <div class="container text-center text-muted small">
        &copy; {{ date('Y') }} Freelance Hub. All rights reserved.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
