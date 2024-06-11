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
            $data = [
                'email' => 'akunuser' . $i . '@gmail.com',
                'password' => Hash::make('akunuser' . $i),
                'name' => 'Akun User ' . $i,
            ];

            User::create($data);
        }
    }
}
