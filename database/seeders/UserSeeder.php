<?php

namespace Database\Seeders;

use App\Models\Biodata;
use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $role  = User::ROLE_ADMIN;

        $this->createUser('My name is owner', 'owner.username', 'owner@gmail.com', User::ROLE_OWNER, $faker);
        $this->createUser('My name is user', 'user.username', 'username@gmail.com', User::ROLE_MEMBER, $faker);
        $this->createUser('My name is admin', 'admin.username', 'admin@gmail.com', User::ROLE_ADMIN, $faker);

        for ($i = 0; $i < 23; $i++) {
            if ($i > 5) {
                $role = User::ROLE_MEMBER;
            }

            $this->createUser($faker->name, $faker->unique()->userName, $faker->unique()->email, $role, $faker);
        }
    }

    private function createUser(string $name, string $username, string $email, string $role, Generator $faker)
    {
        $user = User::query()->create([
            "name"     => $name,
            "username" => $username,
            "email"    => $email,
            "password" => 123456,
            "role"     => $role,
            "avatar"   => UploadedFile::fake()->create(Str::random(40) . 'jpg'),
        ]);

        Biodata::query()->create([
            "user_id" => $user->id,
            "phone"   => $faker->unique()->phoneNumber,
            "address" => $faker->address,
        ]);
    }
}
