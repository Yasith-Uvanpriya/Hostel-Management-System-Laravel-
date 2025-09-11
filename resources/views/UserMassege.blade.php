<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Message Box Design</title>
    <link rel="stylesheet" href="{{ asset('css/usermessage.css') }}">

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

<body class="bg-light min-vh-100 d-flex flex-column">
    <div class="container py-5">
        @include('Nav bar.navbar')
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 col-md-10">
                <div class="text-center mb-4">
                    <h2 class="fw-bold display-6" style="letter-spacing:1px; color:#2c3e50;">📩 Your Messages</h2>
                    <hr class="w-25 mx-auto" style="border-top:2px solid #0d6efd;">
                </div>
                @if($messages->isEmpty())
                    <div class="alert alert-info text-center shadow-sm">You have no messages.</div>
                @else
                    <div class="d-flex flex-column gap-3">
                        @foreach($messages as $message)
                            <!-- Message Card -->
                            <div class="card shadow-sm border-0 position-relative @if(!$message->is_read) border-primary border-2 @endif" style="transition: box-shadow .2s;">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div class="message-preview text-secondary small pe-3">
                                        {{ $message->message }}
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm px-4 rounded-pill" data-bs-toggle="modal" data-bs-target="#messageModal{{ $message->id }}">
                                        View
                                    </button>
                                </div>
                                @if(!$message->is_read)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary shadow" style="font-size:0.7rem;">New</span>
                                @endif
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-labelledby="messageModalLabel{{ $message->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="messageModalLabel{{ $message->id }}">Full Message</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-dark">
                                            {{ $message->message }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
