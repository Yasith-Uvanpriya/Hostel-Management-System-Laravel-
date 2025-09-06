<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
  .table-scroll {
    max-height: 50vh;
    overflow: auto;
  }
  .table-scroll table {
    margin-bottom: 0;
  }
</style>
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
              
              <p class="card-text fs-4">{{ \App\Models\Room::distinct()->count('hostel_name') }}</p>
            </div>
          </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-3">
          <div class="card text-bg-warning mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Rooms</h5>
              <p class="card-text fs-4">$12,340</p>
              <p class="card-text fs-4">{{ \App\Models\Room::count() }}</p>
            </div>
          </div>
        </div>

        <!-- Card 4 -->
        <div class="col-md-3">
          <div class="card text-bg-danger mb-3 shadow">
            <div class="card-body">
              <h5 class="card-title">Beds</h5>
              <p class="card-text fs-4">38</p>
              <p class="card-text fs-4">{{ \App\Models\Room::sum('bed_number') }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Example Table -->
      <div class="card mt-4 shadow" id="recent-users-card">
        <div class="card-header">
          Recent Users
        </div>
        <div class="card-body">
          <div class="table-scroll">
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
          </div>
          <a href="#" class="btn btn-primary" id="btn-view-room">View Room</a>
        </div>
      </div>

    </div>
    <div class="card mt-4 shadow" id="view-room-card" style="display: none;">
        <div class="card-header">
          View Room
        </div>
        <div class="card-body">
          <div class="table-scroll">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Index_no</th>
                <th>Name</th>
                <th>Room NO</th>
                <th>Hostel</th>
                <th>bed number</th>
                <th>Locker No</th>
                <th>entry time DATETIME</th>
                <th>exit time DATETIME</th>

              </tr>
            </thead>
      <tbody>
        @foreach(\App\Models\Room::with('user.profile')->get() as $room)
<tr>
    <td>{{ $room->user?->profile?->Index_no ?? 'N/A' }}</td>
    <td>{{ $room->user?->profile?->name ?? 'N/A' }}</td>
    <td>{{ $room->room_number }}</td>
    <td>{{ $room->hostel_name }}</td>
    <td>{{ $room->bed_number }}</td>
    <td>{{ $room->locker_number }}</td>
    <td>{{ $room->created_at }}</td>
    <td>{{ $room->updated_at }}</td>
</tr>
@endforeach

        
      </tbody>
          </table>
          </div>
          <a href="#" class="btn btn-primary" id="btn-recent-users">Recent Users</a>
        </div>
      </div>
  </div>
  <div > 

  </div>

    </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var recentCard = document.getElementById('recent-users-card');
      var viewRoomCard = document.getElementById('view-room-card');
      var btnViewRoom = document.getElementById('btn-view-room');
      var btnRecentUsers = document.getElementById('btn-recent-users');

      if (btnViewRoom) {
        btnViewRoom.addEventListener('click', function (e) {
          e.preventDefault();
          if (recentCard) recentCard.style.display = 'none';
          if (viewRoomCard) viewRoomCard.style.display = '';
        });
      }

      if (btnRecentUsers) {
        btnRecentUsers.addEventListener('click', function (e) {
          e.preventDefault();
          if (viewRoomCard) viewRoomCard.style.display = 'none';
          if (recentCard) recentCard.style.display = '';
        });
      }
    });
  </script>
</body>
</html>
