<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ["has_read"];

    public function notificationOrders()
    {
        return $this->hasMany(NotificationOrder::class);
    }

    public static function markAllAsRead()
    {
        self::query()->update(["has_read" => 1]);
    }
}
