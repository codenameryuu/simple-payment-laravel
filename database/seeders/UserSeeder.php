<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        for ($i = 1; $i <= 1000; $i++) {
            $firstName = $faker->firstName();
            $lastName = $faker->lastName();

            $email = strtolower($firstName) . strtolower($lastName) . $i . '@gmail.com';
            $password = strtolower($firstName) . strtolower($lastName);
            $name = $firstName . ' ' . $lastName;

            $data = [
                'email' => $email,
                'password' => Hash::make($password),
                'name' => $name,
            ];

            User::create($data);
        }
    }
}
