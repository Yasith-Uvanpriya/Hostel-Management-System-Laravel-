<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sabaragamuwa University Hostel Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
  <div class="hms-container">
    <div class="hms-mainbox">
      <!-- Left Side: Image -->
      <div class="hms-imagebox" style="display: flex; flex-direction: column; align-items: center; gap: 18px;">
        <img src="{{ asset('images/hostel.png') }}" alt="Hostel" class="hms-image">
      </div>
      <!-- Right Side: Description and Buttons -->
      <div class="hms-contentbox" style="align-items: center; text-align: center;">
        <h1 class="hms-title">
          <span class="hms-title-main">Sabaragamuwa University of Sri Lanka</span><br>
          <span class="hms-title-sub">Hostel Management System</span>
        </h1>
        <p class="hms-description" style="font-size: 1.18rem; margin-bottom: 2.2rem;">
          Welcome to the official Hostel Management System of Sabaragamuwa University of Sri Lanka (SUSL).<br>
          <br>
          Sabaragamuwa University, located in Belihuloya, is dedicated to providing a vibrant, secure, and comfortable residential experience for all students. This platform helps you manage your hostel life efficiently and stay connected with the university community.<br>
          <br>
          <strong>Address:</strong> Sabaragamuwa University of Sri Lanka, P.O. Box 02, Belihuloya, 70140, Sri Lanka<br>
          <strong>Contact:</strong> +94-45-2280014 / +94-45-2280087 | <a href="mailto:info@sab.ac.lk">info@sab.ac.lk</a>
        </p>
        <div class="hms-btnrow" style="display: flex; gap: 18px; justify-content: center;">
          <a href="{{ url('/register') }}" class="btn btn-primary hms-btn" style="min-width: 130px;">Register</a>
          <a href="{{ url('/login') }}" class="btn btn-secondary hms-btn" style="min-width: 130px;">Login</a>
          <a href="{{ url('/admin/login') }}" class="btn btn-danger hms-btn" style="min-width: 130px;">Admin Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
