<?php

namespace App\Http\Controllers;
use App\Models\S_profile;

use Illuminate\Http\Request;
use App\Models\SProfile;

class SProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'Index_no' => 'required|integer',
            'Faculty' => 'required|string|max:255',
            'Department' => 'required|string|max:255',
            'Address' => 'required|string|max:255',
            'Blood_Group' => 'required|string|max:3',
            'Medical_Condition' => 'nullable|string|max:255',
            'Telephone' => 'required|string|max:15',
        ]);

        $sProfile = S_profile::updateOrCreate(
            ['user_id' => auth()->id()], // Assuming you have user authentication
            [
                'Index_no' => $request->Index_no,
                'Name' => auth()->user()->name,
                'Faculty' => $request->Faculty,
                'Department' => $request->Department,
                'Address' => $request->Address,
                'Blood_Group' => $request->Blood_Group,
                'Medical_Condition' => $request->Medical_Condition,
                'Telephone' => $request->Telephone,
            ]
            
        
        );
        $sProfile->save();
        $data = S_profile::all();

        return redirect('/profile')->with('success', 'Profile updated successfully!');
    }
}
