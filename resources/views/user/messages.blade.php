<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @include('Nav bar.navbar')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">My Messages</h4>
                    </div>
                    <div class="card-body">
                        @if($messages->isEmpty())
                            <p>You have no messages.</p>
                        @else
                            <ul class="list-group">
                                @foreach($messages as $message)
                                    <li class="list-group-item @if(!$message->is_read) list-group-item-info @endif">
                                        <p>{{ $message->message }}</p>
                                        <small class="text-muted">Received: {{ $message->created_at->format('M d, Y h:i A') }}</small>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
