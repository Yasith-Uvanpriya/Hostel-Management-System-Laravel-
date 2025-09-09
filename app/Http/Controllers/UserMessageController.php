<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $messages = Message::where('user_id', $user->id)->latest()->get();

        // Mark all unread messages as read
        Message::where('user_id', $user->id)->where('is_read', false)->update(['is_read' => true]);

        return view('UserMassege', compact('messages'));
    }

    public function create($type)
    {
        $validTypes = ['water', 'electricity', 'cleaning', 'room'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }

        return view('user.messages.create', compact('type'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'type' => 'required|string|in:water,electricity,cleaning,room',
        ]);

        Message::create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'type' => $request->type,
            'status' => 'Pending',
        ]);

        return redirect('/S_interface')->with('success', 'Your complaint has been submitted successfully!');
    }

    public function destroy(Message $message)
    {
        // Ensure the user owns the message
        if ($message->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $message->delete();

        return redirect('/S_interface')->with('success', 'Notification removed successfully!');
    }
}