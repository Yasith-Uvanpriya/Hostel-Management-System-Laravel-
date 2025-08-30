<?php

namespace App\Http\Controllers;
use App\Models\S_profile;

use Illuminate\Http\Request;
// use App\Models\SProfile; // Removed duplicate import

class SProfileController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            // allow Index_no to be string (IDs can have leading zeros)
            'Index_no' => 'required|string|max:50',
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
                'name' => $request->name ?? auth()->user()->name ?? null, // Set name from auth if missing
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

        return redirect('/S_interface')->with('success', 'Profile updated successfully!');
    }
}
