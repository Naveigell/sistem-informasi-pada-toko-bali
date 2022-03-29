<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App\Models
 * @property \App\Models\ProductImage $image
 * @property int id
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category', 'name', 'description', 'stock', 'price', 'weight',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = \Str::slug($value);
    }

    public function setCategoryAttribute($value)
    {
        $this->attributes['category_id'] = $value;
    }

    public function getConvertedPriceAttribute(): string
    {
        return number_format($this->attributes['price'], 0, ',', '.');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function image(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ProductImage::class);
    }
}
