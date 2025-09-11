<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/room.css') }}">
    <style>
        /* Additional styles to fix dropdown visibility */
        .form-select {
            appearance: auto;
            -webkit-appearance: auto;
            -moz-appearance: auto;
            background-color: #2193b0;
            color: #fff;
            cursor: pointer;
        }
        
        .form-select option {
            background-color: #ffffff;
            color: #333333;
            padding: 10px;
        }
        
        /* Make dropdown options visible */
        select option {
            background-color: white;
            color: #333;
            padding: 10px;
        }
        
        /* Add some spacing between select options */
        .form-select option:not(:last-child) {
            margin-bottom: 5px;
            border-bottom: 1px solid #f0f0f0;
        }
        
        /* Improve form feedback text visibility */
        .form-text {
            color: #185a9d;
            font-weight: 500;
            margin-top: 5px;
        }
        
        /* Improve alert styling */
        .alert {
            border-radius: 14px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        @include('Nav bar.navbar')
        <div class="text-center" style="width: 400px; margin: 0 auto;">
        <h1> Add Room Details</h1>

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

        <form action="/add-room" method="POST">
            @csrf
            <div class="mb-3">
                <label for="hostelName" class="form-label">Which Hostel You currently reside in?</label>
                <select class="form-select" id="hostelName" name="hostel_name" required>
                    <option value="">-- Select a hostel --</option>
                    @php
                        $hostels = $rooms->pluck('hostel_name')->unique();
                    @endphp
                    @foreach($hostels as $hostel)
                        <option value="{{ $hostel }}" {{ old('hostel_name') == $hostel ? 'selected' : '' }}>{{ $hostel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="roomNumber" class="form-label">Room Number</label>
                <select class="form-select" id="roomNumber" name="room_number" required>
                    <option value="">-- Select a room --</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="bedNumber" class="form-label">Bed Number</label>
                <select class="form-select" id="bedNumber" name="number_of_beds" required>
                    <option value="">-- Select a bed --</option>
                </select>
                <div id="bedInfo" class="form-text"></div>
            </div>

            <div class="mb-3">
                <label for="lockerNumber" class="form-label">Locker Number</label>
                <select class="form-select" id="lockerNumber" name="locker_number" required>
                    <option value="">-- Select a locker --</option>
                </select>
                <div class="form-text">Locker options are based on available lockers in the room.</div>
            </div>
            
            <!-- Hidden fields to store room details -->
            <input type="hidden" id="roomBedCount" name="room_bed_count" value="">
            <input type="hidden" id="roomLockerCount" name="room_locker_count" value="">
            <button type="submit" class="btn btn-primary">Add Room</button>
        </form>

        </div>
    </div>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Store all room data from the controller
        const rooms = {!! json_encode($rooms) !!};
        const bookedRooms = {!! json_encode($bookedRooms ?? []) !!}; // Rooms already booked by users

        // Initialize selects with event handlers
        $(document).ready(function() {
            // When hostel is selected
            $('#hostelName').change(function() {
                const selectedHostel = $(this).val();
                updateRoomDropdown(selectedHostel);
                // Reset other dropdowns
                resetBedAndLockerDropdowns();
            });

            // When room is selected
            $('#roomNumber').change(function() {
                const selectedHostel = $('#hostelName').val();
                const selectedRoom = $(this).val();
                updateBedDropdown(selectedHostel, selectedRoom);
                updateLockerDropdown(selectedHostel, selectedRoom);
            });

            // If there's a previously selected hostel (from old input), trigger the change event
            if ($('#hostelName').val()) {
                $('#hostelName').trigger('change');
            }
        });

        // Update room dropdown based on selected hostel
        function updateRoomDropdown(hostelName) {
            const $roomDropdown = $('#roomNumber');
            $roomDropdown.empty().append('<option value="">-- Select a room --</option>');

            if (!hostelName) return;

            // Filter rooms by hostel name
            const hostelRooms = rooms.filter(room => room.hostel_name === hostelName);
            
            // Group rooms by room number
            const uniqueRooms = {};
            hostelRooms.forEach(room => {
                if (!uniqueRooms[room.room_number]) {
                    uniqueRooms[room.room_number] = room;
                }
            });

            // Add room options
            Object.values(uniqueRooms).forEach(room => {
                $roomDropdown.append(`<option value="${room.room_number}" 
                    data-beds="${room.number_of_beds}" 
                    data-lockers="${room.locker_number}">
                    ${room.room_number}
                </option>`);
            });
        }

        // Update bed dropdown based on selected room
        function updateBedDropdown(hostelName, roomNumber) {
            const $bedDropdown = $('#bedNumber');
            $bedDropdown.empty().append('<option value="">-- Select a bed --</option>');
            
            if (!hostelName || !roomNumber) return;

            // Find the selected room
            const selectedRoom = rooms.find(room => 
                room.hostel_name === hostelName && 
                room.room_number === roomNumber
            );

            if (!selectedRoom) return;

            // Store room details in hidden fields
            $('#roomBedCount').val(selectedRoom.number_of_beds);
            $('#roomLockerCount').val(selectedRoom.locker_number);

            // Find beds that are already taken in this room
            const takenBeds = bookedRooms
                .filter(br => br.hostel_name === hostelName && br.room_number === roomNumber)
                .map(br => br.number_of_beds);

            // Add available bed options
            for (let i = 1; i <= selectedRoom.number_of_beds; i++) {
                const isTaken = takenBeds.includes(i.toString());
                if (!isTaken) {
                    $bedDropdown.append(`<option value="${i}">${i}</option>`);
                }
            }

            // Update bed info text
            const availableBeds = selectedRoom.number_of_beds - takenBeds.length;
            $('#bedInfo').text(`${availableBeds} of ${selectedRoom.number_of_beds} beds available`);
        }

        // Update locker dropdown based on selected room
        function updateLockerDropdown(hostelName, roomNumber) {
            const $lockerDropdown = $('#lockerNumber');
            $lockerDropdown.empty().append('<option value="">-- Select a locker --</option>');
            
            if (!hostelName || !roomNumber) return;

            // Find the selected room
            const selectedRoom = rooms.find(room => 
                room.hostel_name === hostelName && 
                room.room_number === roomNumber
            );

            if (!selectedRoom) return;

            // Find lockers that are already taken in this room
            const takenLockers = bookedRooms
                .filter(br => br.hostel_name === hostelName && br.room_number === roomNumber)
                .map(br => br.locker_number);

            // Add available locker options
            for (let i = 1; i <= selectedRoom.locker_number; i++) {
                const isTaken = takenLockers.includes(i.toString());
                if (!isTaken) {
                    $lockerDropdown.append(`<option value="${i}">${i}</option>`);
                }
            }
        }

        // Reset bed and locker dropdowns
        function resetBedAndLockerDropdowns() {
            $('#bedNumber').empty().append('<option value="">-- Select a bed --</option>');
            $('#lockerNumber').empty().append('<option value="">-- Select a locker --</option>');
            $('#bedInfo').text('');
        }
    </script>
</html>
