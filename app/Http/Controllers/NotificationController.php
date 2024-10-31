<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
class NotificationController extends Controller
{
    public function fetchNotifications()
    {
        // Fetch notifications for the logged-in user
        $notifications = Notification::where('user_id', Auth::id())
                                      ->orderBy('created_at', 'desc')
                                      ->get();
    
        return response()->json($notifications);
    }
    
    
    public function markAsRead()
    {
        Notification::where('user_id', Auth::id())->update(['is_read' => true]);
        return response()->json(['message' => 'Notifications marked as read.']);
    }

 


}
