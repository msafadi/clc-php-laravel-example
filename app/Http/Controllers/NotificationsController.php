<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('notifications', [
            'notifications' => $user->notifications,
        ]);
    }

    public function read($id)
    {
        $user = Auth::user();
        $notification = $user->notifications()->where('id', $id)->first();
        if (!$notification) {
            return redirect()->back();
        }

        if (!$notification->read_at) {
            $notification->markAsRead();
        }

        if (isset($notification->data['url']) && $notification->data['url']) {
            return redirect(url($notification->data['url']));
        }

        return redirect()->back();
    }
}
