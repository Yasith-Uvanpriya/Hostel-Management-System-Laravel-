<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .nav-tabs .nav-link.active {
            background-color: white; 
            color: #000;             
            border-color: #dee2e6 #dee2e6 #fff; 
        }
        .nav-tabs .nav-link {
            transition: all 0.3s ease;
        }
        .nav-tabs .nav-link:not(.active):hover {
            background-color: #f8f9fa; 
            color: #0d6efd; 
            border-color: #dee2e6 #dee2e6 #fff;
            border-radius: 0.375rem 0.375rem 0 0;
            text-decoration: none;
        }
        .alert-warning {
            --bs-alert-color: #332701; 
            --bs-alert-bg: white; 
            --bs-alert-border-color: #ffeeba;
            --bs-alert-link-color: #332701; 
        }
    </style>
</head>
<body>
    <div class="container mt-3">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('S_interface') ? 'active' : '' }}" href="/S_interface">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('room') ? 'active' : '' }}" href="/room">Room</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'user.messages' ? 'active' : '' }}" href="{{ route('user.messages') }}">
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

    {{-- Bootstrap JS (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
