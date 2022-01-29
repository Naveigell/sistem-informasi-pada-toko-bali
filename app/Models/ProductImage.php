<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'image'
    ];

    protected $appends = [
        'url'
    ];

    /**
     * @param UploadedFile $file
     */
    public function setImageAttribute($file)
    {
        $extension = $file->getClientOriginalExtension();
        $name      = \Str::uuid() . uniqid() . date('YmdHis') . ".{$extension}";

        Storage::putFileAs('public/images/products', $file, $name);

        $this->attributes['name'] = $name;
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/images/products/' . $this->name);
    }
}
