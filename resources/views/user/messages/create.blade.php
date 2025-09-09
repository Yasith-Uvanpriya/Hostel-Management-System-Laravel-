<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit a Complaint</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Submit a Complaint: {{ ucfirst($type) }}</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('user.complaints.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="type" value="{{ $type }}">

                            <div class="mb-3">
                                <label for="message" class="form-label">Complaint Details</label>
                                <textarea name="message" id="message" class="form-control" rows="5" placeholder="Please describe your complaint in detail..." required>{{ old('message') }}</textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ url('/S_interface') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit Complaint</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
