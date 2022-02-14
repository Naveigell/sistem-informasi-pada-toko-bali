<?php


namespace App\Helper;


use Illuminate\Support\Facades\Http;

final class RajaOngkir
{
    const API_DOMAIN = 'https://api.rajaongkir.com';

    public static function provinces(): array
    {
        $response = self::headers()->get(self::fullDomain() . '/province');

        return $response->json('rajaongkir.results');
    }

    public static function province($province)
    {
        $response = self::headers()->get(self::fullDomain() . '/province', [
            "id" => $province,
        ]);

        return $response->json('rajaongkir.results');
    }

    public static function cost($destinationId, int $weight, string $courier)
    {
        $response = self::headers()->post(self::fullDomain() . '/cost', [
            "destination" => $destinationId,
            "origin"      => config('shipment.shipment_origin_city_id'),
            "weight"      => $weight,
            "courier"     => $courier,
        ]);

        return $response->json('rajaongkir.results');
    }

    /**
     * Get all cities of a province
     *
     * @param $province
     * @return array|mixed
     */
    public static function cities($province)
    {
        $response = self::headers()->get(self::fullDomain() . '/city', [
            "province" => $province,
        ]);

        return $response->json('rajaongkir.results');
    }

    private static function headers(array $headers = [])
    {
        $key = [
            "key" => config('shipment.api_key'),
        ];

        return Http::withHeaders(array_merge($headers, $key));
    }

    private static function fullDomain()
    {
        return self::API_DOMAIN . '/' . config('shipment.account_type');
    }
}
