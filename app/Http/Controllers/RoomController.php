<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;


class RoomController extends Controller
{
    public function add()
    {
        // Get all room configurations from database
        $rooms = Room::all();
        
        // Get rooms that are already assigned to users
        $bookedRooms = Room::whereNotNull('user_id')->get();
        
        return view('room', compact('rooms', 'bookedRooms'));
    }
    public function adminStore(Request $request)
    {
        try {
            $validated = $request->validate([
                'hostel_name' => 'required|string|max:255',
                'room_number' => 'required|string|max:50',
                'number_of_beds' => 'required|integer|min:1',
                'locker_number' => 'required|integer|min:0'
            ]);
            
            // Check for duplicate room in same hostel
            $existingRoom = Room::where('hostel_name', $validated['hostel_name'])
                                ->where('room_number', $validated['room_number'])
                                ->first();
                                
            if ($existingRoom) {
                return redirect('/a_room')->with('error', 'A room with this number already exists in the selected hostel.');
            }

            $room = Room::create([
                'hostel_name' => $validated['hostel_name'],
                'room_number' => $validated['room_number'],
                'number_of_beds' => $validated['number_of_beds'],
                'locker_number' => $validated['locker_number'],
            ]);
            
            return redirect('/a_room')->with('success', 'Room added successfully!');
        } catch (\Exception $e) {
            return redirect('/a_room')->with('error', 'Failed to add room: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required',
            'room_number' => 'required',
            'number_of_beds' => 'required|integer|min:1',
            'locker_number' => 'required|integer|min:0'
        ]);

        // Check if the user already has a room assigned
        $existingUserRoom = Room::where('user_id', auth()->id())->first();
        if ($existingUserRoom) {
            return redirect('/room')->with('error', 'You already have a room assigned. Please contact administration for changes.');
        }

        // Check if the selected bed/locker is already taken
        $existingRoom = Room::where('hostel_name', $request->hostel_name)
                            ->where('room_number', $request->room_number)
                            ->where(function($query) use ($request) {
                                $query->where('number_of_beds', $request->number_of_beds)
                                      ->orWhere('locker_number', $request->locker_number);
                            })
                            ->whereNotNull('user_id')
                            ->first();

        if ($existingRoom) {
            return redirect('/room')->with('error', 'The selected bed or locker is already taken by another student.');
        }

        // Create new room record for this user with their selected bed and locker
        $room = Room::create([
            'hostel_name' => $request->hostel_name,
            'room_number' => $request->room_number,
            'number_of_beds' => $request->number_of_beds,
            'locker_number' => $request->locker_number,
            'user_id' => auth()->id(),
        ]);

        return redirect('/room')->with('success', 'Room assigned successfully!');

    }
}
