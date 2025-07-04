<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoinNotificationModel;

class NotificationController extends Controller
{
    // Return count of unread notifications
    public function count()
    {
        error_log('call count');
        $count = CoinNotificationModel::where('read', 0)->count();
        return response()->json(['count' => $count]);
    }

    // Mark all notifications as read
    public function markRead()
    {
        error_log('call markRead');
        CoinNotificationModel::where('read', 0)->update(['read' => 1]);

        return redirect('admin/view-userslist')->with('status', 'All notifications marked as read');
    }

    public function list()
    {
        $notifications = CoinNotificationModel::orderBy('date', 'desc')->limit(10)->get(['message', 'date']);
        return response()->json(['notifications' => $notifications]);
    }
} 