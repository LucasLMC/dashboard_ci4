<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserFakeSeeder extends Seeder
{
    public function run()
    {
        $userModel = new \App\Models\UserModel();

        $faker = \Faker\Factory::create();

        $qtdUsersCreated = 10;

        $usersPush = [];

        for ($i = 0; $i < $qtdUsersCreated; $i++) {

            array_push($usersPush, [
                'name' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'password' => '123456',
                'active' => $faker->numberBetween(0, 1)
            ]);
        }

        $userModel->skipValidation(true)
            ->protect(true)
            ->insertBatch($usersPush);

        echo "$qtdUsersCreated add with success ";
    }
}
