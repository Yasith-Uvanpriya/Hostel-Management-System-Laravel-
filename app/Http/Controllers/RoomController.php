<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;


class RoomController extends Controller
{
    public function add()
    {
        $rooms = Room::all();
        return view('room', compact('rooms'));
    }
    public function adminStore(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required',
            'room_number' => 'required|unique:rooms',
            'number_of_beds' => 'required|integer|min:1',
            'locker_number' => 'required|integer|min:0'
        ]);

        $room = new Room([
            'hostel_name' => $request->hostel_name,
            'room_number' => $request->room_number,
            'number_of_beds' => $request->number_of_beds,
            'locker_number' => $request->locker_number,
        ]);
        $room->save();
        
        return redirect('/a_room')->with('success', 'Room added successfully!');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required',
            'room_number' => 'required|unique:rooms',
            'number_of_beds' => 'required|integer|min:1',
            'locker_number' => 'required|integer|min:0'
        ]);

        $room = new Room([
            'hostel_name' => $request->hostel_name,
            'room_number' => $request->room_number,
            'number_of_beds' => $request->number_of_beds,
            'locker_number' => $request->locker_number,
        ]);
        $room->user_id = auth()->id();
        $room->save();
        
        $data = Room::all();

        return redirect('/room')->with('success', 'Room added successfully!');

    }
}
