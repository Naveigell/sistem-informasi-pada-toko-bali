<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'shipping_service', 'area_id', 'cost',
    ];

    const SERVICE_REGULAR = 'regular';
    const SERVICE_COD     = 'cod';
}
