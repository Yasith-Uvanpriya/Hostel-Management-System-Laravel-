<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::latest()->take(10)->get();
        $userCount = User::count();

        return view('admin.a_interface', compact('users', 'userCount'));
    }
}
