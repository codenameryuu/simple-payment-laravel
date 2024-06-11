<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;

use App\Helpers\ConstantHelper;

use App\Models\Transaction;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');

        $user = User::all()->pluck('id');

        for ($i = 1; $i <= 10000; $i++) {
            $data = [
                'user_id' => $faker->randomElement($user),
                'amount' => $faker->randomNumber(5, true),
                'status' => $faker->randomElement(ConstantHelper::transactionStatus()),
            ];

            Transaction::create($data);
        }
    }
}
