<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;


class RoomController extends Controller
{
    public function add()
    {
        return view('room');
    }
    public function addRoom(){
        return view('room');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'hostel_name' => 'required',
            'room_number' => 'required|unique:rooms',
            'bed_number' => 'required|integer|min:1',
            'locker_number' => 'required|integer|min:0'
        ]);

        $room = new Room([
            'hostel_name' => $request->hostel_name,
            'room_number' => $request->room_number,
            'bed_number' => $request->bed_number,
            'locker_number' => $request->locker_number,
        ]);
        $room->user_id = auth()->id();
        $room->save();
        
        $data = Room::all();

        return redirect('/room')->with('success', 'Room added successfully!');

    }
}
