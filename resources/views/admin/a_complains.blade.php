<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complaint Details</title>
  <link rel="icon" href="./Components/Images/img.png" type="image/png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="bg-light">
    
        

  <!-- Header -->
  <header class="bg-primary text-white py-3 d-flex align-items-center justify-content-center">
 
    <h1 class="h3 m-0">Complaint Details</h1>
  </header>

  <!-- Main Section -->
  <main class="container py-5">

    <div class="mb-3" >
      <a href="/admin" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back to Complaints List</a>
    </div>

    <!-- Complaint Information -->
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0"><i class="fa-solid fa-clipboard-list"></i> Complaint Information</h5>
      </div>
      <div class="card-body">
        <p><strong>Complaint ID:</strong> #12345</p>
        <p><strong>Complaint Type:</strong> Electrical Issue</p>
        <p><strong>Date Filed:</strong> 2024-08-25</p>
        <p><strong>Hostel:</strong> Sinheraja</p>
        <p><strong>Room Number:</strong> 516</p>
        <p><strong>Status:</strong>
        <p><strong> </strong></p>
          <span id="complaint-status" class="badge bg-warning text-dark">In Progress</span>
        </p>
      </div>
    </div>

    
    <!-- Action Buttons -->
    <div class="d-flex gap-3 mb-5">
      <button class="btn btn-success resolve-btn"><i class="fa-solid fa-check-circle"></i> Mark as Resolved</button>
      <button class="btn btn-primary update-btn"><i class="fa-solid fa-edit"></i> Update Status</button>
    </div>

  </main>

  <!-- Footer -->
  <footer class="bg-dark text-white mt-5">
    <div class="container py-4 d-flex flex-wrap justify-content-between">

      <!-- Contact Info -->
      <div>
        <h5>Contact Info</h5>
        <p class="mb-1">Sabaragamuwa University of Sri Lanka - Hostel Office</p>
        <p class="mb-1">Belihuloya, 70140, Sri Lanka</p>
        <p class="mb-1">Phone: +94-45-2280014</p>
        <p>Email: info@sab.ac.lk</p>
      </div>

      <!-- Quick Links -->
      <div>
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="./index.html" class="text-white text-decoration-none">Dashboard</a></li>
          <li><a href="./Complaints-by-Date.html" class="text-white text-decoration-none">Complaint Details</a></li>
        </ul>
      </div>

      <!-- University Links -->
      <div>
        <h5>University</h5>
        <ul class="list-unstyled">
          <li><a href="https://www.sab.ac.lk" class="text-white text-decoration-none">SUSL Main Website</a></li>
          <li><a href="https://www.sab.ac.lk/faculties" class="text-white text-decoration-none">Faculties</a></li>
          <li><a href="https://www.sab.ac.lk/student-affairs" class="text-white text-decoration-none">Student Affairs</a></li>
          <li><a href="https://ugc.ac.lk" class="text-white text-decoration-none">UGC Sri Lanka</a></li>
        </ul>
      </div>
    </div>

    <div class="bg-secondary text-center py-2">
      <p class="m-0">&copy; 2024 Sabaragamuwa University – Hostel Management System. Developed for SUSL Students.</p>
    </div>
  </footer>

  <!-- Success Modal -->
  <div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="fa-solid fa-check-circle"></i> Successfully Resolved</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>The complaint has been marked as resolved.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Update Status Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="fa-solid fa-edit"></i> Update Complaint Status</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <label for="status-select" class="form-label">Select New Status:</label>
          <select id="status-select" class="form-select">
            <option value="In-Progress">In Progress</option>
            <option value="Pending">Pending</option>
          </select>
          <div id="update-message" class="alert alert-success mt-3 d-none">Status updated successfully!</div>
        </div>
        <div class="modal-footer">
          <button id="update-status-btn" class="btn btn-primary">Update Status</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
 


  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const resolveButton = document.querySelector('.resolve-btn');
      const updateButton = document.querySelector('.update-btn');
      const complaintStatus = document.getElementById('complaint-status');
      const statusSelect = document.getElementById('status-select');
      const updateMessage = document.getElementById('update-message');

      resolveButton.addEventListener('click', function () {
        complaintStatus.textContent = 'Resolved';
        complaintStatus.className = "badge bg-success";
        new bootstrap.Modal(document.getElementById('successModal')).show();
      });

      updateButton.addEventListener('click', function () {
        new bootstrap.Modal(document.getElementById('updateModal')).show();
      });

      document.getElementById('update-status-btn').addEventListener('click', function () {
        const newStatus = statusSelect.value;
        complaintStatus.textContent = newStatus.replace(/-/g, ' ');
        complaintStatus.className =
          newStatus === 'Pending' ? "badge bg-danger" :
            newStatus === 'In-Progress' ? "badge bg-warning text-dark" :
              "badge bg-secondary";
        updateMessage.classList.remove('d-none');
        setTimeout(() => updateMessage.classList.add('d-none'), 3000);
      });
    });
  </script>
</body>

</html>
