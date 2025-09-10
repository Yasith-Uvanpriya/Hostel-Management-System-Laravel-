<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\Room;
use App\Models\S_profile;


class AdminMessageController extends Controller
{
    public function index($type = null)
    {
        $query = Message::with(['user.room', 'user.profile'])->where('type', '!=', 'admin');

        if ($type) {
            $query->where('type', $type);
        }

        $messages = $query->latest()->get();

        return view('admin.a_complains', compact('messages', 'type'));
    }
    public function create()
    {
        $users = User::all(); // Get all users
        $messages = Message::with('user')->where('type', 'admin')->latest()->get();
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
                'message' => $request->message,
                'type' => 'admin'
            ]);
        } else {
            // Send to all users
            $users = User::all();
            foreach ($users as $user) {
                Message::create([
                    'user_id' => $user->id,
                    'message' => $request->message,
                    'type' => 'admin'
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

    public function updateStatus(Request $request, Message $message)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Resolved',
        ]);

        $message->status = $request->status;
        $message->save();

        return redirect()->back()->with('success', 'Complaint status updated successfully!');
    }
}
