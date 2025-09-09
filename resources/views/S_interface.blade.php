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

        <div class="d-flex justify-content-center mt-4" style="gap: 30px; width: 1100px">
            <!-- Profile Card -->
            <div class="card-body p-4"
                style="background-color:#f8f9fa; width: 350px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
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
            <div style="width: 300px; max-height: 70vh; overflow-y: auto;">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(isset($messages) && $messages->count() > 0)
                    @foreach($messages as $message)
                        <div class="alert alert-{{ $message->status == 'Resolved' ? 'success' : 'warning' }}" role="alert">
                            <h6 class="alert-heading">Complaint #{{ $message->id }} - {{ ucfirst($message->type) }}</h6>
                            <p>{{ Str::limit($message->message, 50) }}</p>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-0">Status: <strong>{{ $message->status }}</strong></p>
                                @if($message->status == 'Resolved')
                                    <form action="{{ route('user.complaints.destroy', $message->id) }}" method="POST" class="mb-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Remove</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-info" role="alert">
                        You have no submitted complaints.
                    </div>
                @endif
            </div>
        </div>

        <!-- Complaint Boxes Section -->
        <div class="row mt-5 g-4">
            <div class="col-md-3 col-6">
                <a href="{{ route('user.complaints.create', 'water') }}" class="complaint-box water d-flex align-items-center justify-content-center text-decoration-none">
                    <h5 class="text-white text-center">Water Complaints</h5>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('user.complaints.create', 'electricity') }}" class="complaint-box electricity d-flex align-items-center justify-content-center text-decoration-none">
                    <h5 class="text-white text-center">Electricity Complaints</h5>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('user.complaints.create', 'cleaning') }}" class="complaint-box cleaning d-flex align-items-center justify-content-center text-decoration-none">
                    <h5 class="text-white text-center">Cleaning Complaints</h5>
                </a>
            </div>
            <div class="col-md-3 col-6">
                <a href="{{ route('user.complaints.create', 'room') }}" class="complaint-box room d-flex align-items-center justify-content-center text-decoration-none">
                    <h5 class="text-white text-center">Room Complaints</h5>
                </a>
            </div>
        </div>

    </div>

    <style>
        .complaint-box {
            height: 150px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .complaint-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .water { background: #1e8fffde; }       /* Blue */
        .electricity { background: #ffa600e6; } /* Orange */
        .cleaning { background: #32cd32e1; }    /* Green */
        .room { background: #ff6347de; }        /* Red */
    </style>

</body>
</html>
