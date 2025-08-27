<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="text-center">
        <h1>Welcome to the Hostel Management System</h1>
        <p>This is a simple Laravel application for managing hostel operations.</p>
        </div>
        <div class="text-center">
            <a href="{{ url('/register') }}" class="btn btn-primary m-2">Register</a>
            <a href="{{ url('/login') }}" class="btn btn-secondary m-2">Login</a>
        </div>

</body>
</html>