<?php


namespace App\Traits;


use App\Helper\RajaOngkir;
use App\Models\Shipping;

trait AppendRajaOngkir
{
    private function appendRajaOngkir(Shipping &$shipping)
    {
        $shipping->destination_details = RajaOngkir::destinationDetails($shipping->city, $shipping->weight, $shipping->courier);
    }
}
