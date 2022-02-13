<?php

namespace App\Http\Controllers\Member;

use App\Helper\RajaOngkir;
use App\Http\Controllers\Controller;
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

    public function cost($destinationId): array
    {
        return RajaOngkir::cost($destinationId, 1700, "pos");
    }
}
