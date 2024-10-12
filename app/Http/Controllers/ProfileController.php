<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ensure the email is unique except for the current user
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Max 5MB
            'password' => 'nullable|string|min:8',
        ]);
    
        $user = User::findOrFail($id);
    
        // Handle file upload if exists, otherwise keep the current image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
            $user->image = $imagePath;
        }
    
        // Update user details
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
    
        // Only update the password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        // Save the changes
        $user->save();
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    
    
}

