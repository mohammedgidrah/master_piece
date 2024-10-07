<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index() {
        // Fetch all users
        $users = User::all();
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        // Show the form to create a new user
        return view('users.create');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|mimes:png,jpg,jpeg,webp',
        ]);

        // Handle the image upload if provided
        if ($request->has('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/usersprofiles/';
            $file->move($path, $filename);
            $imagePath = $path . $filename;
        } else {
            // Set default image if none is uploaded
            $imagePath = 'uploads/usersprofiles/default.png';
        }

        // Create a new user
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'image' => $imagePath,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Fetch the user by ID
        return view('dashboard.users.edit', compact('user')); // Pass the user to the view
    }



    public function update(Request $request, int $id)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'password' => 'nullable|string|min:8',
        ]);
        
    
        // Find the user by ID
        $user = User::findOrFail($id);
    
        // Define the upload path
        $path = 'uploads/usersprofiles/';
    
        // Use existing image unless a new one is uploaded
        $filename = $user->image;
    
        // If a new image is uploaded
        if($request->hasFile('image')){
            $file= $request->file('image');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $path='uploads/usersprofiles/';
            $file->move($path,$filename);
            if(File::exists($user->image)){
                File::delete($user->image);
            }
        }
    
        // Update user information
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email ?? $user->email,  // Use existing email if not provided
            'address' => $request->address,
            'phone' => $request->phone,
            'image' => $filename ?? $user->image,
        ]);
        
    
        // Check if a password is being updated
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
    
        // Save the user data
        $user->save();
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    

    

    public function destroy(User $user)
    {
        if (File::exists($user->image)) {
        File::delete($user->image);
    }
        // Delete a specific user
        $user->delete();
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
}
