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
  <h2 class="mb-4 text-center">📩 Messages</h2>

  @if($messages->isEmpty())
      <p class="text-center">You have no messages.</p>
  @else
      @foreach($messages as $message)
          <!-- Message Card -->
          <div class="card shadow-sm mb-3 @if(!$message->is_read) border-primary @endif">
              <div class="card-body d-flex justify-content-between align-items-center">
                  <div class="message-preview">
                      {{ $message->message }}
                  </div>
                  <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}">
                      View
                  </button>
              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Full Message</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                          {{ $message->message }}
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
  @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
