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
              <h5 class="card-title">Orders</h5>
              <p class="card-text fs-4">75</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3">
          <div class="card text-bg-warning mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Revenue</h5>
              <p class="card-text fs-4">$12,340</p>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3">
          <div class="card text-bg-danger mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Errors</h5>
              <p class="card-text fs-4">3</p>
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
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john@example.com</td>
                <td>2025-08-01</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>jane@example.com</td>
                <td>2025-08-10</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>

    </div>
</body>
</html>