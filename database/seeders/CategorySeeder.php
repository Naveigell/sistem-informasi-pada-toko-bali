<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->insert([
            [
                "name"       => "Herbal",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ],
            [
                "name"       => "Baju Pria",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ],
            [
                "name"       => "Baju Wanita",
                "created_at" => now()->toDateTimeString(),
                "updated_at" => now()->toDateTimeString(),
            ],
        ]);
    }
}
