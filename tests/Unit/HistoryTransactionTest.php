<?php

namespace Tests\Unit;

use Tests\TestCase;

class HistoryTransactionTest extends TestCase
{
    /**
     ** Test to get history transaction with fail response
     ** Testcase : unauthenticated
     */
    public function test_get_history_transaction_fail_unauthenticated()
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

        $this->json('GET', '/api/payment/transaction/history/' . $login['data']['hash_id'])
            ->assertStatus(401)
            ->assertJsonStructure([
                'status',
                'message',
            ]);
    }

    /**
     ** Test to get history transaction with fail response
     ** Testcase : invalid payload
     */
    public function test_get_history_transaction_fail_invalid_payload()
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
            ->json('GET', '/api/payment/transaction/history/' . $login['data']['hash_id'])
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message',
            ]);
    }

    /**
     ** Test to get history transaction with success response
     */
    public function test_get_history_transaction_success()
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
            ->json('GET', '/api/payment/transaction/history/' . $login['data']['hash_id'], [
                'page' => 1,
                'per_page' => 10,
                'sort_key' => 'created_at',
                'sort_order' => 'desc',
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'pagination',
            ]);
    }
}
