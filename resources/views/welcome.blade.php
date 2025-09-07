<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

<link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
  <div class="container">
    <div class="welcome-box" style="max-width: 500px; margin: auto;">
      <h1 class="mb-3">🏠 Hostel Management System</h1>
      <p class="mb-4">A simple Laravel application for managing hostel operations.</p>
      <div class="d-flex justify-content-center gap-3 flex-wrap">
        <a href="{{ url('/register') }}" class="btn btn-primary btn-custom">Register</a>
        <a href="{{ url('/login') }}" class="btn btn-secondary btn-custom">Login</a>
        <a href="{{ url('/admin/login') }}" class="btn btn-danger btn-custom">Admin Login</a>
      </div>
    </div>
  </div>
</body>
</html>
