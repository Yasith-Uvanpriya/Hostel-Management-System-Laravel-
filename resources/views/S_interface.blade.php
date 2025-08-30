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
        <h1 class="text-center">Student Interface</h1>
        <div class="text-center">
            <h1> Hi I am {{ Auth::user()->name }}</h1>
            <a href="{{ url('/profile/' . Auth::user()->id) }}" class="btn btn-primary">Profile</a>
        </div>
    </div>
</body>
</html>