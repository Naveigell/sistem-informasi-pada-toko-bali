<?php

namespace App\View\Composers;

use App\Models\Notification;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view)
    {
        $notifications = Notification::with('notificationOrders')->where('has_read', false)->get();

        $view->with('notifications', $notifications);
    }
}
