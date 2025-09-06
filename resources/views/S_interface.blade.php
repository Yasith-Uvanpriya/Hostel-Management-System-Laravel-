<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Hi Wellcome {{ Auth::user()->name }}</h1>

        @include('Nav bar.navbar')

        <div class="d-flex justify-content-center mt-4" style="gap: 30px;">
            <!-- Profile Card -->
            <div class="card-body p-4"
                style="background-color:#f8f9fa; width: 400px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                @if(isset($sProfile))
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Index No:</div>
                        <div class="col-sm-8">{{ $sProfile->Index_no }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Name:</div>
                        <div class="col-sm-8">{{ $sProfile->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Faculty:</div>
                        <div class="col-sm-8">{{ $sProfile->Faculty }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Department:</div>
                        <div class="col-sm-8">{{ $sProfile->Department }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Address:</div>
                        <div class="col-sm-8">{{ $sProfile->Address }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Blood Group:</div>
                        <div class="col-sm-8">{{ $sProfile->Blood_Group }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Medical Condition:</div>
                        <div class="col-sm-8">{{ $sProfile->Medical_Condition }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Telephone:</div>
                        <div class="col-sm-8">{{ $sProfile->Telephone }}</div>
                    </div>
                @else
                    <div class="row mb-3">
                        <div class="col-sm-12">No profile found. <a href="{{ url('/profile') }}">Create one</a></div>
                    </div>
                @endif

                <div class="text-center mt-3">
                    <a href="{{ url('/profile/' . Auth::user()->id) }}" class="btn btn-primary">Edit profile</a>
                </div>
            </div>

            <!-- Notification Alert -->
            <div style="width: 300px;">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <strong><i class="bi bi-bell"></i> Notifications</strong>
                    </div>
                    <div class="list-group list-group-flush" style="max-height: 70vh; overflow-y: auto;">
                        @if(isset($unread_messages) && $unread_messages->count() > 0)
                            @foreach($unread_messages as $message)
                                <a href="{{ route('user.messages') }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">New Message</h6>
                                        <small>{{ $message->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ Str::limit($message->message, 50) }}</p>
                                </a>
                            @endforeach
                        @else
                            <div class="list-group-item">
                                <p class="mb-0">No new notifications.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
