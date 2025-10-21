<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Details</title>
  <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="bg-light">

  @php
      $typeColors = [
          'water' => 'primary',
          'electricity' => 'warning',
          'cleaning' => 'success',
          'room' => 'danger',
      ];
  @endphp

  <!-- Header -->
  <header class="bg-info text-white py-3 d-flex align-items-center justify-content-center">
    <h1 class="h3 m-0"><i class="fa-solid fa-clipboard-list"></i> {{ $type ? ucfirst($type) : 'All' }} Complaints</h1>
  </header>

  <!-- Main Section -->
  <main class="container py-5">

    <div class="mb-3">
      <a href="/admin" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
    </div>

    @if($messages->isEmpty())
        <div class="alert alert-info">
            No {{ $type ? $type : '' }} complaints found.
        </div>
    @else
        @foreach($messages as $message)
            @php
                $cardColor = $typeColors[$message->type] ?? 'info';
            @endphp
            <div class="card mb-4 shadow-sm {{ $message->status == 'Resolved' ? 'bg-secondary text-white' : '' }}">
              <div class="card-header bg-{{ $cardColor }} text-white">
                <h5 class="mb-0"><i class="fa-solid fa-clipboard-list"></i> Complaint #{{ $message->id }}</h5>
              </div>
              <div class="card-body">
                <p><strong>Complaint ID:</strong> #{{ $message->id }}</p>
                <p><strong>Complaint Type:</strong> {{ ucfirst($message->type) }}</p>
                <p><strong>Date Filed:</strong> {{ $message->created_at->format('Y-m-d') }}</p>
                <p><strong>Hostel:</strong> {{ $message->user->room->hostel_name ?? 'N/A' }}</p>
                <p><strong>Room Number:</strong> {{ $message->user->room->room_number ?? 'N/A' }}</p>
                <p><strong>Status:</strong>
                  <span class="badge bg-{{ $message->status == 'Resolved' ? 'success' : ($message->status == 'In Progress' ? 'warning' : 'danger') }}">
                    {{ $message->status }}
                  </span>
                </p>
                <hr>
                <p><strong>Student Name:</strong> {{ $message->user->name ?? 'N/A' }}</p>
                <p><strong>Student Email:</strong> {{ $message->user->email ?? 'N/A' }}</p>
                <hr>
                <p><strong>Complaint Details:</strong></p>
                <p>{{ $message->message }}</p>
              </div>
              <div class="card-footer">
                <form action="{{ route('admin.complaints.updateStatus', $message->id) }}" method="POST" class="d-flex gap-3">
                    @csrf
                    @method('PUT')
                    <select name="status" class="form-select">
                        <option value="Pending" {{ $message->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="In Progress" {{ $message->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ $message->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
              </div>
            </div>
        @endforeach
    @endif

  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white mt-5">
    <div class="container py-4">
      <div class="row">
        <div class="col-md-4">
          <h5>Contact Info</h5>
          <p>Sabaragamuwa University of Sri Lanka - Hostel Office</p>
          <p>Belihuloya, 70140, Sri Lanka</p>
        </div>
        <div class="col-md-4">
          <h5>Quick Links</h5>
          <ul class="list-unstyled">
            <li><a href="/admin" class="text-white text-decoration-none">Dashboard</a></li>
          </ul>
        </div>
        <div class="col-md-4">
            <h5>University</h5>
            <ul class="list-unstyled">
              <li><a href="https://www.sab.ac.lk" class="text-white text-decoration-none">SUSL Main Website</a></li>
            </ul>
        </div>
      </div>
    </div>
    <div class="bg-secondary text-center py-2">
      <p class="m-0">&copy; {{ date('Y') }} Sabaragamuwa University – Hostel Management System.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
