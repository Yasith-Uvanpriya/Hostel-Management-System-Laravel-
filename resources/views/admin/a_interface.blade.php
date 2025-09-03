<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        @include('admin.Dashboard')
        <!-- Main Content -->
  <div class="content" style="margin-top: 80px;">
    <div class="container-fluid">
      

      <div class="row">
        <!-- Card 1 -->
        <div class="col-md-3">
          <div class="card text-bg-primary mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Users</h5>
              <p class="card-text fs-4">{{ \App\Models\User::count() }}</p>
            </div>
          </div>
        </div>

        <!-- Card 2 -->
        <div class="col-md-3">
          <div class="card text-bg-success mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Hostels</h5>
              <p class="card-text fs-4">7</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3">
          <div class="card text-bg-warning mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Rooms</h5>
              <p class="card-text fs-4">$12,340</p>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3">
          <div class="card text-bg-danger mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Beds</h5>
              <p class="card-text fs-4">38</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Example Table -->
      <div class="card mt-4 shadow">
        <div class="card-header">
          Recent Users
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Index_no</th>
                <th>Name</th>
                <th>Faculty</th>
                <th>Department</th>
                <th>Address</th>
                <th>Blood Group</th>
                <th>Medical Condition</th>
                <th>Telephone</th>

              </tr>
            </thead>
      <tbody>
        @foreach(\App\Models\S_profile::all() as $user)
          <tr>
            <td>{{ $user->Index_no }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->Faculty }}</td>
            <td>{{ $user->Department }}</td>
            <td>{{ $user->Address }}</td>
            <td>{{ $user->Blood_Group }}</td>
            <td>{{ $user->Medical_Condition }}</td>
            <td>{{ $user->Telephone }}</td>
          </tr>
        @endforeach
        
      </tbody>
          </table>
          <a href="#" class="btn btn-primary">View Room</a>
        </div>
      </div>

    </div>
    <div class="card mt-4 shadow">
        <div class="card-header">
          Recent Users
        </div>
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Index_no</th>
                <th>Name</th>
                <th>Faculty</th>
                <th>Department</th>
                <th>Address</th>
                <th>Blood Group</th>
                <th>Medical Condition</th>
                <th>Telephone</th>

              </tr>
            </thead>
      <tbody>
        @foreach(\App\Models\S_profile::all() as $user)
          <tr>
            <td>{{ $user->Index_no }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->Faculty }}</td>
            <td>{{ $user->Department }}</td>
            <td>{{ $user->Address }}</td>
            <td>{{ $user->Blood_Group }}</td>
            <td>{{ $user->Medical_Condition }}</td>
            <td>{{ $user->Telephone }}</td>
          </tr>
        @endforeach
        
      </tbody>
          </table>
          <a href="#" class="btn btn-primary">View Room</a>
        </div>
      </div>
  </div>
  <div > 

  </div>

    </div>
</body>
</html>