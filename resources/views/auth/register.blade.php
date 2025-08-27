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
      <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="mb-3" style="width:100px; margin:100px auto;">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
          @error('name')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3" style="width:400px; margin:0 auto;">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" aria-describedby="emailHelp">
          <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
          @error('email')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div class="mb-3" style="width:400px; margin:0 auto;">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password">
          @error('password')
            <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>

        <div style="width:400px; margin:0 auto;">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>

        </div>
    </div>
    
</body>
</html>