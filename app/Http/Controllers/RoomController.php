<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\models\Room;

class RoomController extends Controller
{
    public function add()
    {
        return view('room');
    }
}
