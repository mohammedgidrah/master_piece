<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webg|max:5120',  
        ]);

        // Set the default image path
        $imagePath = 'uploads/usersprofiles/defultimage/userimage.png';  

        // Check if an image was uploaded
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
    }

        // Check if the user is already registered
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            // If the user is already registered, log them in
            auth()->login($existingUser);
            // Redirect to the home page after login
            return redirect()->route('home')->with('success', 'You are already registered and have been logged in.');
        }

        // If the user does not exist, create a new one
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'image' => $imagePath, // Store the path of the uploaded or default image
        ]);

        // Log the user in automatically
        auth()->login($user);

        // Redirect to the home page after successful login
        return redirect()->route('home')->with('success', 'Registration successful. You are now logged in.');
    }
}
