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
        <h1 class="text-center">Hi Wellcome {{ Auth::user()->name }}</h1>
        <div class="text-center">
            <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
        </div>

    <div>
      <div class="card-body p-4" style="background-color:#f8f9fa; width: 600px; margin: 0 ; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        @if(isset($sProfile))
          <div class="row mb-3">
            <div class="col-sm-4 fw-bold">Index No:</div>
            <div class="col-sm-8">{{ $sProfile->Index_no }}</div>
          </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Name:</div>
                <div class="col-sm-8">{{ $sProfile->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Faculty:</div>
                <div class="col-sm-8">{{ $sProfile->Faculty }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Department:</div>
                <div class="col-sm-8">{{ $sProfile->Department }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Address:</div>
                <div class="col-sm-8">{{ $sProfile->Address }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Blood Group:</div>
                <div class="col-sm-8">{{ $sProfile->Blood_Group }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Medical Condition:</div>
                <div class="col-sm-8">{{ $sProfile->Medical_Condition }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4 fw-bold">Telephone:</div>
                <div class="col-sm-8">{{ $sProfile->Telephone }}</div>
            </div>
        @else
          <div class="row mb-3">
            <div class="col-sm-12">No profile found. <a href="{{ url('/profile') }}">Create one</a></div>
          </div>
        @endif

            <div class="text-center" style="margin-top: 20px;">
                <a href="{{ url('/profile/' . Auth::user()->id) }}" class="btn btn-primary">Edit profile</a>
            
        </div>
        
</div>
</div>
    </div>
</body>
</html>