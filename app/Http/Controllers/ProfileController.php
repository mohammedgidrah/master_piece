<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional, max size 2MB
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
            'password' => [
                'nullable',
                'string',
                'min:8', // Minimum length
                'regex:/[a-z]/', // At least one lowercase letter
                'regex:/[A-Z]/', // At least one uppercase letter
                'regex:/[0-9]/', // At least one number
                'regex:/[\W_]/', // At least one special character
            ],
        ], [
            'password.regex' => 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
    
        $user = User::findOrFail($id);
        $defaultImagePath = 'uploads/usersprofiles/defaultimage/userimage.png'; // Replace with your actual default image path

        // Handle file upload if exists
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not the default image
            if ($user->image && $user->image !== $defaultImagePath) {
                Storage::disk('public')->delete($user->image); // Deletes only non-default images
            }
    
            // Store the new image
            $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
            $user->image = $imagePath; // Update the user's image path
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

