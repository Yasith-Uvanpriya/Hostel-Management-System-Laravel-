<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message Box Design</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .message-preview {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      max-width: 70%;
    }
  </style>
</head>
<body class="bg-light">
    

<div class="container mt-5">
    @include('Nav bar.navbar')
    <div style="margin-top: 40px;">
  <h2 class="mb-4 text-center" >📩 Messages</h2>

  <!-- Message Card -->
  <div class="card shadow-sm mb-3">
    <div class="card-body d-flex justify-content-between align-items-center">
      <div class="message-preview">
        msg
      </div>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal1">
        View
      </button>
    </div>
  </div>

  
  

<!-- Modal 1 -->
<div class="modal fade" id="messageModal1" tabindex="-1" aria-labelledby="messageModal1Label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModal1Label">Full Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed luctus urna in nunc suscipit, nec facilisis nulla faucibus. 
        Curabitur eget dolor nec justo feugiat fermentum non vel augue. Integer feugiat blandit lorem, vel elementum ipsum.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
