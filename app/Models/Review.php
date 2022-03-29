<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $attributes = [])
 */
class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'star', 'description',
    ];
}
