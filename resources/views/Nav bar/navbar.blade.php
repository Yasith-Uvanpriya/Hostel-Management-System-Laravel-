<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        
    <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="/S_interface">Profile</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/room">Room</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('user.messages') }}">
        Messages
        @if(isset($unread_messages) && $unread_messages->count() > 0)
            <span class="badge bg-primary rounded-pill">{{ $unread_messages->count() }}</span>
        @endif
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
</ul>
        </div>
    
</body>
</html>