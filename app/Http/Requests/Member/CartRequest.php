<?php

namespace App\Http\Requests\Member;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if logged user is user
        return in_array(optional(auth()->user())->role, [User::ROLE_MEMBER]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = Product::query()->findOrFail($this->product_id);

        return [
            "quantity"   => "required|min:1|integer|max:{$product->stock}",
            "product_id" => "required|min:1|integer",
        ];
    }
}
