<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;


class AdminMessageController extends Controller
{
    public function create()
    {
        $users = User::all(); // Get all users
        return view('admin.messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        if ($request->user_id) {
            // Send to specific user
            Message::create([
                'user_id' => $request->user_id,
                'message' => $request->message
            ]);
        } else {
            // Send to all users
            $users = User::all();
            foreach ($users as $user) {
                Message::create([
                    'user_id' => $user->id,
                    'message' => $request->message
                ]);
            }
        }

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
