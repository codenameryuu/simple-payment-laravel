<?php

namespace Tests\Feature;

use Tests\TestCase;

class SummaryTransactionTest extends TestCase
{
    /**
     ** Test to get summary transaction with fail response
     ** Testcase : unauthenticated
     */
    public function test_get_summary_transaction_fail_unauthenticated()
    {
        $this->json('GET', '/api/payment/transaction/summary')
            ->assertStatus(401)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     ** Test to get summary transaction with success response
     */
    public function test_get_summary_transaction_success()
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
            ->json('GET', '/api/payment/transaction/summary')
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
            ]);
    }
}
