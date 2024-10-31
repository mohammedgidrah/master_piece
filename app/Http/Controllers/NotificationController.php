<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
 class NotificationController extends Controller
{

    public function index()
    {
        $notifications = Notification::all(); // Adjust the query as necessary

        return view('dashboard.maindasboard', compact('notifications'));
    }
    

    
    
    public function markAsRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
    
        return redirect()->back();
    }
    
 


}
