<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function api_show($user_id){
        // return 'This is Dashboard';
        $notifications = NotificationModel::where('uid', $user_id)->get();

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for this user'], 404);
        }
        return response()->json(['data' => $notifications], 200);
     }
}
