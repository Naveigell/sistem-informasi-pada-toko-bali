<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @property mixed status
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_id', 'payment_proof', 'sender_bank', 'sender_account_number', 'sender_name', 'merchant_bank',
    ];

    public const BANK_ACCOUNT = [
        "bri" => "158201000250561",
    ];

    public const BANK_ACCOUNT_NAME = [
        "I Gusti Nyoman Natih Mahadikha Pinatih",
    ];

    public const STATUSES = [
        "valid"   => "Valid",
        "invalid" => "Invalid",
    ];

    /**
     * @param UploadedFile $file
     */
    public function setPaymentProofAttribute($file)
    {
        $extension = $file->getClientOriginalExtension();
        $name      = \Str::uuid() . uniqid() . date('YmdHis') . ".{$extension}";

        Storage::putFileAs('public/images/payments', $file, $name);

        $this->attributes['payment_proof'] = $name;
        $this->attributes['date']          = now()->toDateTimeString();
    }

    public function getPaymentProofUrlAttribute(): string
    {
        return asset('storage/images/payments/' . $this->payment_proof);
    }
}
