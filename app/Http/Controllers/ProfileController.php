<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'password' => 'nullable|string|min:8',
        ]);
        
        // Use the current image unless a new one is uploaded
        $filename = $user->image;
        $path = 'uploads/usersprofiles/';

        // If a new image is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move($path, $filename);

            // Delete the old image if it exists
            if (File::exists($user->image)) {
                File::delete($user->image);
            }
        }

        // Update user information
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? $user->email, // Use existing email if not provided
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $path . $filename,
        ]);

        // Check if a password is being updated
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
dd($request->all());
        // Save the user data
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
