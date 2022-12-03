<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Faker\Factory;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('id_ID');

        for ($i = 0; $i < rand(4, 6); $i++) {
            Testimonial::create([
                "description" => $faker->realText,
                "star"        => rand(3, 5),
            ]);
        }
    }
}
