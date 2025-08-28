<?php

namespace App\Http\Controllers;
use App\Models\S_profile;

use Illuminate\Http\Request;
use App\Models\SProfile;

class SProfileController extends Controller
{
    public function edit($id)
    {
        $profile = SProfile::findOrFail($id);
        return view('Profile')->with('profile', $profile);
    }
}
