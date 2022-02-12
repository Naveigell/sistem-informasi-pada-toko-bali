<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'area', 'cost',
    ];

    public function getConvertedCostAttribute(): string
    {
        return number_format($this->attributes['cost'], 0, ',', '.');
    }
}
