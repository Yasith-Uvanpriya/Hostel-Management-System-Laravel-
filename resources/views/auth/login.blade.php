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
        <div class="text-center" style="margin:175px auto;">
            <form method="POST" action="{{ url('/login') }}">
    @csrf
     <div class="mb-3" style="width:400px; margin:0 auto;">
    <label for="email" class="form-label">Email address</label>
    <input type="email" name="email" placeholder="Email" class="form-control">
</div>
<div class="mb-3" style="width:400px; margin:0 auto;">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" placeholder="Password" class="form-control">
    <button type="submit" class="btn btn-primary">Login</button>
</form>

        </div>
    </div>
</body>
</html>