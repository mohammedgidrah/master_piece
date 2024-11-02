<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {

        $notifications = Auth::user()->notifications;
        return view('dashboard.maindasboard', compact('notifications'));
    }

    public function handleOrder($id, $order_id)
    {
        // Find the notification
        $notification = Notification::find($id);

        if ($notification) {
            // Optionally, you can delete it or mark it as read
            $notification->delete(); // or $notification->markAsRead();
        }

        // Redirect to the specific order page
        return redirect()->route('ordersdash.index', ['id' => $order_id])->with('success', 'Redirected to order.');
    }
    public function handleUserProfile($notificationId, $userId)
    {

        $notification = Notification::find($notificationId);

        if ($notification) {
            // Optionally, you can delete it or mark it as read
            $notification->delete(); // or $notification->markAsRead();
        } else {
            return redirect()->route('notifications.index')->with('error', 'Notification not found.');
        }
        $user = User::find($userId);

        return redirect()->route('users.index', ['id' => $user->id])->with('success', 'Redirected to user profile.');
    }
}
