<?php

namespace Tests\Feature;

use Tests\TestCase;

use App\Models\Transaction;
use App\Models\User;

class UpdateTransactionTest extends TestCase
{
    /**
     ** Test to update transaction with fail response
     ** Testcase : unauthenticated
     */
    public function test_update_transaction_fail_unauthenticated()
    {
        $user = User::firstWhere('email', 'fikrisabriansyah@gmail.com');
        $transaction = Transaction::firstWhere('user_id', $user->id);

        $this->json('PUT', '/api/payment/transaction/' . $transaction->hash_id)
            ->assertStatus(401)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     ** Test to update transaction with fail response
     ** Testcase : invalid payload
     */
    public function test_update_transaction_fail_invalid_payload()
    {
        $user = User::firstWhere('email', 'fikrisabriansyah@gmail.com');
        $transaction = Transaction::firstWhere('user_id', $user->id);

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
            ->json('PUT', '/api/payment/transaction/' . $transaction->hash_id)
            ->assertStatus(422)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }

    /**
     ** Test to update transaction with success response
     */
    public function test_update_transaction_success()
    {
        $user = User::firstWhere('email', 'fikrisabriansyah@gmail.com');
        $transaction = Transaction::firstWhere('user_id', $user->id);

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
            ->json('PUT', '/api/payment/transaction/' . $transaction->hash_id, [
                'status' => 'Completed'
            ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message'
            ]);
    }
}
