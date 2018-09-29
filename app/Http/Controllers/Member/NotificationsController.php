<?php

namespace App\Http\Controllers\Member;

use App\Transformers\NotificationTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notification;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $member = \Auth::guard('member')->user();

        $notifications = $member->notifications()->get();

        $member->markAsRead();

        return view('member.notifications.index', compact('member', 'notifications'));
    }

}
