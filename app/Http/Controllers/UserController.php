<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // Get the per_page value, defaulting to 20
        $perPage = $request->input('per_page', 5);

        // Cap the maximum number of users displayed to 20
        if ($perPage === 'all' || $perPage > 20) {
            $perPage = 20; // Limit to 20 when 'all' is selected
        }

        $roleFilter = $request->input('role');
        $search = $request->input('search');

        $query = User::query();

        // Apply role filter if provided
        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        // Apply search filter if provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Get users with pagination
        $users = $query->paginate($perPage);
        $totalUsers = User::count();

        return view('dashboard.users.index', compact('users', 'totalUsers'));
    }

    public function create()
    {
        // Show the form to create a new user
        return view('dashboard.users.create');
    }
    public function show()
    {
        // Show the form to create a new user
        // return view('users.create');
    }
    public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'role' => 'required|in:admin,user',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'password' => 'required|string|min:8',
        'image' => 'nullable|mimes:png,jpg,jpeg,webp',
    ]);

 

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('uploads/usersprofiles', 'public');
    }

    // Create a new user
    User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'role' => $request->role,
        'address' => $request->address,
        'phone' => $request->phone,
        'password' => bcrypt($request->password),
        'image' => $imagePath,
    ]);

    return redirect()->route('users.index')->with('success', 'User created successfully.');
}


    public function edit($id)
    {
        $users = User::findOrFail($id); // Fetch the user by ID
        return view('dashboard.users.edit', compact('users')); // Pass the user to the view
    }

  

    public function update(Request $request, $id)
{
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Ensure unique email
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        'password' => 'nullable|string|min:8',
        'role' => 'required|in:admin,user',
    ]);

    $user = User::findOrFail($id);

    // Handle file upload if exists
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($user->image && \Storage::disk('public')->exists($user->image)) {
            \Storage::disk('public')->delete($user->image);
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

    // Only update password if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->password); // Hash the new password
    }

    // Save the changes
    $user->save();

    return redirect()->route('users.index')->with('success', 'Profile updated successfully!');
}


    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::find($id);

        // Check if the user exists
        if (!$user) {
            return redirect()->route('users.index')->with('error', "User with ID {$id} not found.");
        }

        // Delete the user's image if it exists
        if ($user->image && File::exists(public_path($user->image))) {
            File::delete(public_path($user->image));
        }

        // Delete the user
        $user->delete();

        // Redirect back to the users list with a success message
        return redirect()->route('users.index')->with('success', "User was deleted successfully.");
    }

}
