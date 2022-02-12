<?php

namespace Database\Seeders;

use App\Models\ShippingCost;
use Illuminate\Database\Seeder;

class ShippingCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ShippingCost::query()->insert([
            [
                "area" => "Denpasar",
                "cost" => 70000,
                "created_at" => now()->toDateString(),
                "updated_at" => now()->toDateString(),
            ],
            [
                "area" => "Tabanan",
                "cost" => 10000,
                "created_at" => now()->toDateString(),
                "updated_at" => now()->toDateString(),
            ],
        ]);
    }
}
