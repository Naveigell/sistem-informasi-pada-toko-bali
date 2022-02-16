<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'address', 'phone', 'shipping_service', 'province', 'city', 'courier', 'zip', 'area_id', 'cost',
    ];

    const SERVICE_REGULAR     = 'regular';
    const SERVICE_OUR_COURIER = 'our-courier';

    /**
     * available courier for regular shipment
     */
    const SHIPPING_REGULAR_COURIER = [
        "jne"  => "Jalur Nugraha Ekakurir (JNE)",
        "tiki" => "Citra Van Titipan Kilat (TIKI)",
        "pos"  => "POS Indonesia (POS)",
    ];
}
