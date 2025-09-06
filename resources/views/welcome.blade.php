<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <style>
    body {
      background: linear-gradient(135deg, #007bff, #6610f2);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    .welcome-box {
      background: white;
      color: #333;
      padding: 40px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      transition: transform 0.2s ease-in-out;
    }
    .welcome-box:hover {
      transform: scale(1.02);
    }
    .btn-custom {
      min-width: 120px;
      font-weight: 600;
      border-radius: 50px;
      transition: 0.3s;
    }
    .btn-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
  </style>
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
