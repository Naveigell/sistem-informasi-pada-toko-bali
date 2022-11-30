<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Review;
use App\Models\Shipping;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users     = User::all();
        $products  = Product::all();
        $shippings = Shipping::all();

        $faker   = Factory::create();
        $reviews = [];

        for ($i = 0; $i < 25; $i++) {
            $reviews[] = [
                "user_id"     => $users->random()->id,
                "product_id"  => $products->random()->id,
                "shipping_id" => $shippings->random()->id,
                "star"        => rand(1, 5),
                "description" => $faker->text,
                "created_at"  => now()->toDateTimeString(),
                "updated_at"  => now()->toDateTimeString(),
            ];
        }

        Review::insert($reviews);
    }
}
