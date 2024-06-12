<?php

namespace Tests\Feature;

use Tests\TestCase;
use Faker\Factory;

class CreateTransactionTest extends TestCase
{
    /**
     ** Test to create transaction with fail response
     ** Testcase : unauthenticated
     */
    public function test_create_transaction_fail_unauthenticated()
    {
        $this->json('POST', '/api/payment/transaction/create')
            ->assertStatus(401)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     ** Test to create transaction with fail response
     ** Testcase : invalid payload
     */
    public function test_create_transaction_fail_invalid_payload()
    {
        $login = $this->json('POST', '/api/login', [
            'email' => 'fikrisabriansyah@gmail.com',
            'password' => 'fikrisabriansyah',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'token',
            ]);

        $this->withHeader('Authorization', 'Bearer ' . $login['token'])
            ->json('POST', '/api/payment/transaction/create')
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     ** Test to create transaction with success response
     */
    public function test_create_transaction_success()
    {
        $faker = Factory::create('id_ID');

        $login = $this->json('POST', '/api/login', [
            'email' => 'fikrisabriansyah@gmail.com',
            'password' => 'fikrisabriansyah',
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'token',
            ]);

        $this->withHeader('Authorization', 'Bearer ' . $login['token'])
            ->json('POST', '/api/payment/transaction/create', [
                'user_id' => $login['data']['hash_id'],
                'amount' => $faker->randomFloat(2, 100000, 999999),
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data'
            ]);
    }
}
