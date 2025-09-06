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

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Ensure the admin user exists with the correct details.
        $adminUser = User::firstOrNew(['email' => 'admin@gmail.com']);
        if (!$adminUser->exists) {
            $adminUser->name = 'Admin';
            $adminUser->password = bcrypt('admin');
            $adminUser->is_admin = true;
            $adminUser->save();
        }

        if (auth()->attempt($credentials)) {
            if (auth()->user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }
            // Log out if not an admin
            auth()->logout();
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
