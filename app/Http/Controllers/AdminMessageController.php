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
        $messages = Message::with('user')->latest()->get();
        return view('admin.messages.create', compact('users', 'messages'));
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

    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Message deleted successfully!');
    }
}
