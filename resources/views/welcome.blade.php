<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
  <div class="hms-container">
    <div class="hms-mainbox">
      <!-- Left Side: Image -->
      <div class="hms-imagebox">
        <img src="{{ asset('images/hostel.png') }}" alt="Hostel" class="hms-image">
      </div>
      <!-- Right Side: Description and Buttons -->
      <div class="hms-contentbox">
        <h1 class="hms-title">🏠 Hostel Management System</h1>
        <p class="hms-description">
          Welcome to your all-in-one solution for hostel management! Effortlessly organize rooms, users, and messages with a modern, secure, and user-friendly Laravel platform. Experience seamless operations and a vibrant community—where comfort meets convenience.
        </p>
        <div class="hms-btnrow">
          <a href="{{ url('/register') }}" class="btn btn-primary hms-btn">Register</a>
          <a href="{{ url('/login') }}" class="btn btn-secondary hms-btn">Login</a>
          <a href="{{ url('/admin/login') }}" class="btn btn-danger hms-btn">Admin Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
