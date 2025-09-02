<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <li><a class="dropdown-item hostel-item" href="#" data-value="Hostel A">Hostel A</a></li>
                        <li><a class="dropdown-item hostel-item" href="#" data-value="Hostel B">Hostel B</a></li>
                        <li><a class="dropdown-item hostel-item" href="#" data-value="Hostel C">Hostel C</a></li>
                    </ul>
                </div>
                <input type="hidden" id="hostelName" name="hostelName" value="{{ old('hostelName') }}" required>
            </div>

            <div class="mb-3">
                <label for="roomNumber" class="form-label">Room Number</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="roomDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="roomToggleLabel">{{ old('roomNumber') ?: 'Select Your Room Number' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="roomDropdownToggle">
                        <li><a class="dropdown-item room-item" href="#" data-value="Room 101">Room 101</a></li>
                        <li><a class="dropdown-item room-item" href="#" data-value="Room 102">Room 102</a></li>
                        <li><a class="dropdown-item room-item" href="#" data-value="Room 201">Room 201</a></li>
                    </ul>
                </div>
                <input type="hidden" id="roomNumber" name="roomNumber" value="{{ old('roomNumber') }}" required>
            </div>

            <div class="mb-3">
                <label for="bedCount" class="form-label">Bed Count</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="bedDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="bedToggleLabel">{{ old('bedCount') ?: 'Select Bed Count' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bedDropdownToggle">
                        <li><a class="dropdown-item bed-item" href="#" data-value="1">1</a></li>
                        <li><a class="dropdown-item bed-item" href="#" data-value="2">2</a></li>
                        <li><a class="dropdown-item bed-item" href="#" data-value="3">3</a></li>
                        <li><a class="dropdown-item bed-item" href="#" data-value="4">4</a></li>
                    </ul>
                </div>
                <input type="hidden" id="bedCount" name="bedCount" value="{{ old('bedCount') }}" required>
            </div>

            <div class="mb-3">
                <label for="lockerCount" class="form-label">Locker Count</label>
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="lockerDropdownToggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <span id="lockerToggleLabel">{{ old('lockerCount') ?: 'Select Locker Count' }}</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="lockerDropdownToggle">
                        <li><a class="dropdown-item locker-item" href="#" data-value="1">1</a></li>
                        <li><a class="dropdown-item locker-item" href="#" data-value="2">2</a></li>
                        <li><a class="dropdown-item locker-item" href="#" data-value="3">3</a></li>
                        <li><a class="dropdown-item locker-item" href="#" data-value="4">4</a></li>
                    </ul>
                </div>
                <input type="hidden" id="lockerCount" name="lockerCount" value="{{ old('lockerCount') }}" required>
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
            // load admin-added rooms from localStorage and inject into dropdowns
            try{
                var stored = JSON.parse(localStorage.getItem('rooms') || '[]');
                if(Array.isArray(stored) && stored.length){
                    var hostelMenu = document.querySelector('#hostelDropdownToggle + .dropdown-menu') || document.querySelector('.dropdown-menu[aria-labelledby="hostelDropdownToggle"]');
                    var roomMenu = document.querySelector('#roomDropdownToggle + .dropdown-menu') || document.querySelector('.dropdown-menu[aria-labelledby="roomDropdownToggle"]');
                    // helper to check existing values
                    function existsInMenu(menu, value, attr){
                        if(!menu) return false;
                        var items = menu.querySelectorAll('.dropdown-item');
                        for(var i=0;i<items.length;i++){
                            if((attr === 'text' && items[i].textContent.trim() === value) || (attr === 'data' && items[i].getAttribute('data-value') === value)) return true;
                        }
                        return false;
                    }

                    stored.forEach(function(r){
                        if(!r || !r.hostel_name) return;
                        // add hostel if missing
                        if(hostelMenu && !existsInMenu(hostelMenu, r.hostel_name, 'data')){
                            var li = document.createElement('li');
                            li.innerHTML = '<a class="dropdown-item hostel-item" href="#" data-value="'+r.hostel_name+'">'+r.hostel_name+'</a>';
                            hostelMenu.appendChild(li);
                        }
                        // add room if missing
                        if(roomMenu && !existsInMenu(roomMenu, r.room_number, 'data')){
                            var li2 = document.createElement('li');
                            var a = document.createElement('a');
                            a.className = 'dropdown-item room-item';
                            a.href = '#';
                            a.setAttribute('data-value', r.room_number);
                            a.setAttribute('data-hostel', r.hostel_name);
                            a.setAttribute('data-bed', String(r.bed_number || ''));
                            a.setAttribute('data-locker', String(r.locker_number || ''));
                            a.textContent = r.room_number + ' (' + r.hostel_name + ')';
                            li2.appendChild(a);
                            roomMenu.appendChild(li2);
                        }
                    });
                }
            }catch(e){
                // ignore storage errors
                console.warn('load rooms failed', e);
            }

            // hostel dropdown
            var hostelHidden = document.getElementById('hostelName');
            var hostelLabel = document.getElementById('hostelToggleLabel');
            var hostelItems = document.querySelectorAll('.hostel-item');
            if(hostelHidden && hostelLabel){
                if(hostelHidden.value) hostelLabel.textContent = hostelHidden.value;
                hostelItems.forEach(function(it){
                    it.addEventListener('click', function(e){
                        e.preventDefault();
                        var v = this.getAttribute('data-value') || '';
                        hostelHidden.value = v;
                        hostelLabel.textContent = v || 'Select hostel';
                    });
                });
            }

            // room dropdown
            var roomHidden = document.getElementById('roomNumber');
            var roomLabel = document.getElementById('roomToggleLabel');
            var roomItems = document.querySelectorAll('.room-item');
            if(roomHidden && roomLabel){
                if(roomHidden.value) roomLabel.textContent = roomHidden.value;
                roomItems.forEach(function(it){
                    it.addEventListener('click', function(e){
                        e.preventDefault();
                        var v = this.getAttribute('data-value') || '';
                        roomHidden.value = v;
                        roomLabel.textContent = v || 'Select Your Room Number';
                    });
                });
            }

            // bed and locker dropdowns with sync
            var bedHidden = document.getElementById('bedCount');
            var lockerHidden = document.getElementById('lockerCount');
            var bedLabel = document.getElementById('bedToggleLabel');
            var lockerLabel = document.getElementById('lockerToggleLabel');
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
        });
    </script>
</html>