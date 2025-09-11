<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('css/room.css') }}">
</head>
<body>
    <div class="container mt-5">
        @include('Nav bar.navbar')
        <div class="text-center" style="width: 400px; margin: 0 auto;">
        <h1> Add Room Details</h1>

        <form action="/add-room" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hostelName" class="form-label">Which Hostel You currently reside in?</label>
                <input type="text" class="form-control" id="hostelName" name="hostel_name" value="{{ old('hostelName') }}" required placeholder="Enter hostel name">
            </div>

            <div class="mb-3">
                <label for="roomNumber" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="roomNumber" name="room_number" value="{{ old('roomNumber') }}" required placeholder="Enter room number">
            </div>

            <div class="mb-3">
                <label for="bedCount" class="form-label">Bed Count</label>
                <input type="number" class="form-control" id="bedCount" name="number_of_beds" min="1" max="10" value="{{ old('number_of_beds') }}" required placeholder="Enter bed count">
            </div>

            <div class="mb-3">
                <label for="lockerCount" class="form-label">Locker Count</label>
                <input type="number" class="form-control" id="lockerCount" name="locker_number" min="1" max="10" value="{{ old('locker_number') }}" required placeholder="Enter locker count">
                <div class="form-text">Locker defaults to selected bed count but can be changed.</div>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>

        </div>
    </div>
</body>
    <!-- No JS needed for simple input fields -->
</html>
