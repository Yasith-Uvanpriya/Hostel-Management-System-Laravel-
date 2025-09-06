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

        return view('user.messages', compact('messages'));
    }
}