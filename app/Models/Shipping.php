<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shipping
 * @property array|mixed destination_details
 * @property mixed city
 * @property mixed weight
 * @property mixed courier
 * @property mixed shipping_service
 * @property mixed id
 * @property mixed payment
 * @package App\Models
 * @method static|Builder memberShipping()
 */
class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id", 'name', 'email', 'address', 'phone', 'shipping_service', 'province', 'city', 'courier', 'zip', 'area_id', 'total', 'cost', 'weight',
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

    public function getCourierFullNameAttribute()
    {
        if (in_array($this->shipping_service, [self::SERVICE_REGULAR])) {
            return self::SHIPPING_REGULAR_COURIER[$this->courier];
        }
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getTotalPaymentAttribute()
    {
        return number_format($this->attributes['cost'] + $this->attributes['total'], 0, ',', '.');
    }

    public function getConvertedCostAttribute()
    {
        return number_format($this->cost, 0, ',', '.');
    }

    public function getConvertedTotalAttribute()
    {
        return number_format($this->total, 0, ',', '.');
    }

    /**
     * @param Builder $query
     */
    public function scopeMemberShipping($query)
    {
        $query->where('user_id', auth()->id());
    }
}
