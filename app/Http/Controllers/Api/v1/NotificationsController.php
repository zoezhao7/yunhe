<?php

namespace App\Http\Controllers\Api\v1;

use App\Transformers\NotificationTransformer;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        $employee = \Auth::guard('api')->user();
        $notifications = $employee->notifications()->paginate(20);

        // 更新消息为已读
        $employee->markAsRead();

        return $this->response->paginator($notifications, new NotificationTransformer());
    }

    public function workbenchIndex()
    {
        $employee = \Auth::guard('api')->user();
        $notifications = $employee->notifications()->paginate(10);

        return $this->response->paginator($notifications, new NotificationTransformer());
    }

}
