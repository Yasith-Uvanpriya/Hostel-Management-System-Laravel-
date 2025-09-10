<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('css/room.css') }}">
</head>
<body>
    <div class="container mt-5">
        @include('Nav bar.navbar')
        <div class="text-center" style="width: 400px; margin: 0 auto;">
        <h1> Add Room Details</h1>

        <form action="/add-room" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hostelName" class="form-label">Which Hostel You currently reside in?</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="hostelDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="hostelToggleLabel">{{ old('hostelName') ?: 'Select hostel' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="hostelDropdownToggle">
                        @foreach($rooms->unique('hostel_name') as $room)
                            <li><a class="dropdown-item hostel-item" href="#" data-value="{{ $room->hostel_name }}">{{ $room->hostel_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="hostelName" name="hostel_name" value="{{ old('hostelName') }}" required>
            </div>

            <div class="mb-3">
                <label for="roomNumber" class="form-label">Room Number</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="roomDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="roomToggleLabel">{{ old('roomNumber') ?: 'Select Your Room Number' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="roomDropdownToggle">
                        @foreach($rooms as $room)
                            <li><a class="dropdown-item room-item" href="#" data-value="{{ $room->room_number }}" data-beds="{{ $room->number_of_beds }}" data-hostel="{{ $room->hostel_name }}">{{ $room->room_number }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <input type="hidden" id="roomNumber" name="room_number" value="{{ old('roomNumber') }}" required>
            </div>

            <div class="mb-3">
                <label for="bedCount" class="form-label">Bed Number</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="bedDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="bedToggleLabel">{{ old('bedCount') ?: 'Select Bed Count' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bedDropdownToggle">
                        <!-- Bed count will be populated by JavaScript -->
                    </ul>
                </div>
                <input type="hidden" id="bedCount" name="number_of_beds" value="{{ old('bedCount') }}" required>
            </div>

            <div class="mb-3">
                <label for="lockerCount" class="form-label">Locker Number</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="lockerDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="lockerToggleLabel">{{ old('lockerCount') ?: 'Select Locker Count' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="lockerDropdownToggle">
                        <!-- Locker count will be populated by JavaScript -->
                    </ul>
                </div>
                <input type="hidden" id="lockerCount" name="locker_number" value="{{ old('lockerCount') }}" required>
                <div class="form-text">Locker defaults to selected bed count but can be changed.</div>
            </div>
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>

        </div>
    </div>
</body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const rooms = @json($rooms);

            // hostel dropdown
            var hostelHidden = document.getElementById('hostelName');
            var hostelLabel = document.getElementById('hostelToggleLabel');
            var hostelItems = document.querySelectorAll('.hostel-item');
            var roomItems = document.querySelectorAll('.room-item');
            var roomDropdown = document.querySelector('[aria-labelledby="roomDropdownToggle"]');

            if(hostelHidden && hostelLabel){
                if(hostelHidden.value) hostelLabel.textContent = hostelHidden.value;
                hostelItems.forEach(function(it){
                    it.addEventListener('click', function(e){
                        e.preventDefault();
                        var v = this.getAttribute('data-value') || '';
                        hostelHidden.value = v;
                        hostelLabel.textContent = v || 'Select hostel';

                        // Filter rooms based on hostel
                        roomItems.forEach(function(roomItem) {
                            if (roomItem.dataset.hostel === v) {
                                roomItem.style.display = 'block';
                            } else {
                                roomItem.style.display = 'none';
                            }
                        });
                    });
                });
            }

            // room dropdown
            var roomHidden = document.getElementById('roomNumber');
            var roomLabel = document.getElementById('roomToggleLabel');
            var bedDropdown = document.querySelector('[aria-labelledby="bedDropdownToggle"]');
            var lockerDropdown = document.querySelector('[aria-labelledby="lockerDropdownToggle"]');
            var bedHidden = document.getElementById('bedCount');
            var lockerHidden = document.getElementById('lockerCount');
            var bedLabel = document.getElementById('bedToggleLabel');
            var lockerLabel = document.getElementById('lockerToggleLabel');

            if(roomHidden && roomLabel){
                if(roomHidden.value) roomLabel.textContent = roomHidden.value;
                roomItems.forEach(function(it){
                    it.addEventListener('click', function(e){
                        e.preventDefault();
                        var v = this.getAttribute('data-value') || '';
                        var beds = this.getAttribute('data-beds') || 0;
                        roomHidden.value = v;
                        roomLabel.textContent = v || 'Select Your Room Number';

                        // Populate bed and locker dropdowns
                        bedDropdown.innerHTML = '';
                        lockerDropdown.innerHTML = '';
                        for (let i = 1; i <= beds; i++) {
                            bedDropdown.innerHTML += `<li><a class="dropdown-item bed-item" href="#" data-value="${i}">${i}</a></li>`;
                            lockerDropdown.innerHTML += `<li><a class="dropdown-item locker-item" href="#" data-value="${i}">${i}</a></li>`;
                        }

                        // Add event listeners to new bed and locker items
                        addBedLockerListeners();
                    });
                });
            }

            function addBedLockerListeners() {
                var bedItems = document.querySelectorAll('.bed-item');
                var lockerItems = document.querySelectorAll('.locker-item');
                var lockerManuallyChanged = false;

                if(bedHidden && lockerHidden && bedLabel && lockerLabel){
                    if(bedHidden.value) bedLabel.textContent = bedHidden.value;
                    if(lockerHidden.value) lockerLabel.textContent = lockerHidden.value;

                    bedItems.forEach(function(b){
                        b.addEventListener('click', function(e){
                            e.preventDefault();
                            var v = this.getAttribute('data-value') || '';
                            bedHidden.value = v;
                            bedLabel.textContent = v || 'Select Bed Count';
                            if(!lockerManuallyChanged){
                                lockerHidden.value = v;
                                lockerLabel.textContent = v || 'Select Locker Count';
                            }
                        });
                    });

                    lockerItems.forEach(function(l){
                        l.addEventListener('click', function(e){
                            e.preventDefault();
                            var v = this.getAttribute('data-value') || '';
                            lockerHidden.value = v;
                            lockerLabel.textContent = v || 'Select Locker Count';
                            lockerManuallyChanged = true;
                        });
                    });
                }
            }
            addBedLockerListeners();
        });
    </script>
</html>
