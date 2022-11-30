<?php

namespace App\Http\Requests\Member;

use App\Models\Payment;
use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    public function authorize()
    {
        $shipping = $this->route('shipping');

        return $shipping->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "payment_proof"         => "required|file|mimes:jpg,png,jpeg|max:10000",
            "sender_bank"           => "required|string|min:3",
            "sender_name"           => "required|string|min:3",
            "sender_account_number" => "required|string|min:3|max:30",
            "merchant_bank"         => "required|string|in:" . join(',', array_keys(Payment::BANK_ACCOUNT)),
        ];
    }

    public function attributes()
    {
        return [
            "sender_bank"           => "your bank name",
            "sender_name"           => "your account name",
            "sender_account_number" => "your bank account number",
            "merchant_bank"         => "bank to send",
        ];
    }
}
