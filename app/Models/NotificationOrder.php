<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationOrder extends Model
{
    use HasFactory;

    protected $fillable = ["order_id", "notification_id"];
}
