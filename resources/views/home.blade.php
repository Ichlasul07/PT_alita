<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Pilih Menu</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="{{ route('employees.index') }}" class="btn btn-primary btn-lg w-100">Employee</a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('locations.index') }}" class="btn btn-secondary btn-lg w-100">Location</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
