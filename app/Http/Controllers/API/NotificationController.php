<?php

namespace App\Http\Controllers\API;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id',$request->user_id)->get();

        return response()->json(['notifications' => $notifications,'message' => 'Notifications get'], 200);
    }

    public function read(Request $request)
    {
        $notification = Notification::where('id',$request->id)->first();
        $notification->update(['is_read' => true]);

        return response()->json(['notificationRead' => [],'message' => 'Readed'], 200);
    }
}
