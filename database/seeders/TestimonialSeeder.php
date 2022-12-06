<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
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
        $users = User::member()->get();

        for ($i = 0; $i < rand(4, 6); $i++) {
            Testimonial::create([
                "user_id"     => $users->random()->id,
                "username"    => $faker->userName,
                "description" => $faker->realText,
                "star"        => rand(3, 5),
            ]);
        }
    }
}
