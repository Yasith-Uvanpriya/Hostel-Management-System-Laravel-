<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div style="display: flex; flex-direction: column; align-items: left; margin-top: 20px; ">
        <div>
        @include('admin.Dashboard')
        </div>
        <div class="container" style="margin-top: 20px; max-width: 800px;">
        <h1>Add Room</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="/aroom" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hostel_name" class="form-label">Hostel Name</label>
                <input type="text" class="form-control" id="hostel_name" name="hostel_name" required>
            </div>
            <div class="mb-3">
                <label for="room_number" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="room_number" name="room_number" required>
            </div>
            <div class="mb-3">
                <label for="number_of_beds" class="form-label">Bed Count</label>
                <a href="#" class="btn btn-secondary m-2 bed-choice" data-value="4">4</a>
                <a href="#" class="btn btn-secondary m-2 bed-choice" data-value="6">6</a>
                <a href="#" class="btn btn-secondary m-2 bed-choice" data-value="8">8</a>
                <!-- hidden input so bed count is submitted; locker input will display/edit this value -->
                <input type="hidden" id="number_of_beds" name="number_of_beds" value="">
            </div>
            <div class="mb-3">
                <label for="locker_number" class="form-label">Locker Count</label>
                <input type="text" class="form-control" id="locker_number" name="locker_number" required>
                <div class="form-text">This value mirrors the selected bed count but is editable.</div>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function(){
                var locker = document.getElementById('locker_number');
                var bed = document.getElementById('number_of_beds');
                var choices = document.querySelectorAll('.bed-choice');
                if(!locker || !bed) return;

                // initialize from existing locker value if present
                bed.value = locker.value || '';

                // clicking a bed button sets both locker input and hidden bed value
                choices.forEach(function(btn){
                    btn.addEventListener('click', function(e){
                        e.preventDefault();
                        var val = this.getAttribute('data-value') || '';
                        locker.value = val;
                        bed.value = val;
                        // toggle active styling
                        choices.forEach(function(b){ b.classList.remove('btn-primary'); b.classList.add('btn-secondary'); });
                        this.classList.remove('btn-secondary');
                        this.classList.add('btn-primary');
                    });
                });

                // when locker number changes manually, mirror to hidden bed input
                locker.addEventListener('input', function(){
                    bed.value = this.value;
                    // remove active style from choices since custom value
                    choices.forEach(function(b){ b.classList.remove('btn-primary'); b.classList.add('btn-secondary'); });
                });
            });
        </script>
        
        <hr class="my-4">
        
        <div class="mt-5">
            <h2>Existing Rooms</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Hostel Name</th>
                            <th>Room Number</th>
                            <th>Bed Count</th>
                            <th>Locker Count</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>{{ $room->hostel_name }}</td>
                                <td>{{ $room->room_number }}</td>
                                <td>{{ $room->number_of_beds }}</td>
                                <td>{{ $room->locker_number }}</td>
                                <td>{{ $room->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No rooms added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        