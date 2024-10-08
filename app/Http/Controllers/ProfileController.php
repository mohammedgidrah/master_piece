<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'password' => 'nullable|string|min:8',
        ]);

        // Use existing image unless a new one is uploaded
        $imagePath = $user->image; // Use existing image by default

        // Handle the uploaded image
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/usersprofiles/';
            $file->move(public_path($path), $filename);
            $imagePath = $path . $filename;

            // Delete the old image if it exists
            if (File::exists(public_path($user->image))) {
                File::delete(public_path($user->image));
            }
        }

        // Prepare the update data
        $updateData = [
            'first_name' => $request->input('first_name', $user->first_name),
            'last_name' => $request->input('last_name', $user->last_name),
            'email' => $request->input('email', $user->email), // Ensure email is provided
            'address' => $request->input('address', $user->address),
            'phone' => $request->input('phone', $user->phone),
            'role' => $request->input('role', $user->role), // Assuming role is also being updated
            'image' => $imagePath, // Use the new or existing image
        ];

        // Hash the password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->input('password'));
        }

        // Update the user information
        $user->update($updateData);

        // Redirect back with success message
        return back()->with('success', 'User updated successfully.');
    }
}

