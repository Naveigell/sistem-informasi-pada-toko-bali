<?php

namespace App\Models;

use App\Traits\ModelBulkUpdate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Shipping
 * @property array|mixed destination_details
 * @property mixed city
 * @property int weight
 * @property string courier
 * @property mixed shipping_service
 * @property mixed id
 * @property Payment payment
 * @property string tracking_id
 * @property \Illuminate\Database\Eloquent\Collection<Order> orders
 * @package App\Models
 * @method static|Builder memberShipping()
 * @method Builder bulkUpdate(array $values, string $column, string $table = null)
 */
class Shipping extends Model
{
    use HasFactory, ModelBulkUpdate;

    protected $fillable = [
        'user_id', 'tracking_id', 'name', 'email', 'address', 'phone', 'shipping_service', 'province', 'city', 'courier', 'zip',
        'area_id', 'total', 'cost', 'weight', 'shipping_status',
    ];

    const SERVICE_REGULAR     = 'regular';
    const SERVICE_OUR_COURIER = 'our-courier';

    const SHIPPING_STATUSES = [
        "on_delivery" => "On Delivery",
        "standing"    => "Standing",
        "arrived"     => "Arrived",
    ];

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

    public function area()
    {
        return $this->belongsTo(ShippingCost::class, 'area_id');
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
