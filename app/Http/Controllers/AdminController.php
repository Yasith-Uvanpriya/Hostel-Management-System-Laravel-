<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Room;
use App\Models\S_profile;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $search = $request->input('search');
        $roomSearch = $request->input('room_search');

        $sprofiles = S_profile::query()
            ->when($search, function ($query, $search) {
                return $query->where('Index_no', 'like', "%{$search}%")
                             ->orWhere('name', 'like', "%{$search}%");
            })
            ->get();

        $rooms = Room::with('user.profile')
            ->when($roomSearch, function ($query, $roomSearch) {
                // Split the search string by space
                $keywords = explode(' ', $roomSearch);

                foreach ($keywords as $keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where('hostel_name', 'like', "%{$keyword}%")
                          ->orWhere('room_number', 'like', "%{$keyword}%")
                          ->orWhere('number_of_beds', 'like', "%{$keyword}%");
                    });
                }
                return $query;
            })
            ->get();

        $users = User::latest()->take(10)->get();
        $userCount = User::count();

        return view('admin.a_interface', compact('users', 'userCount', 'sprofiles', 'rooms', 'search', 'roomSearch'));
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
