<?php

namespace App\Http\Controllers\Member;

use App\Helper\RajaOngkir;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class ShippingCostController extends Controller
{
    public function province($provinceId): array
    {
        return RajaOngkir::province($provinceId);
    }

    public function cities($provinceId): array
    {
        return RajaOngkir::cities($provinceId);
    }

    public function cost($destinationId, $courier): array
    {
        // get total weight of member product
        $weight = Cart::memberCarts()->with('product')->get()
                                     ->reduce(function ($total, $cart) {
                                            return $total + ($cart->product->weight * $cart->quantity);
                                        }, 0);

        return RajaOngkir::cost($destinationId, $weight, $courier);
    }
}
