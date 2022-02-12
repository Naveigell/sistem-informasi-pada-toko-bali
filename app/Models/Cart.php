<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cart
 * @package App\Models
 * @method static|Builder memberCarts()
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * @param Builder $query
     */
    public function scopeMemberCarts($query)
    {
        $query->where('user_id', auth()->id());
    }
}
