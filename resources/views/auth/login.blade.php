<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Hostel Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-mainbox">
        <div class="login-imagebox">
            <img src="{{ asset('images/login.jpg') }}" alt="Login" class="login-image">
        </div>
        <div class="login-contentbox">
            <h2 class="login-title">Sign In To Your Account</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" placeholder="name@example.com" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary"><span>Login</span></button>
                </div>
            </form>
            <div class="mt-4 text-center">
                <span>Don't have an account?</span>
                <a href="{{ url('/register') }}" class="text-primary text-decoration-underline ms-1">Register</a>
            </div>
        </div>
    </div>
</body>
</html>
