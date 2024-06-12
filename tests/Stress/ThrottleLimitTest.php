<?php

namespace Tests\Stress;

use Tests\TestCase;

class ThrottleLimitTest extends TestCase
{
    /**
     ** Test to check throttle limit
     */
    public function test_throttle_limit()
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

        for ($i = 0; $i < 105; $i++) {
            $this->withHeader('Authorization', 'Bearer ' . $login['token'])
                ->json('GET', '/api/payment/transaction/summary');
        }

        $this->withHeader('Authorization', 'Bearer ' . $login['token'])
            ->json('GET', '/api/payment/transaction/summary')
            ->assertStatus(429)
            ->assertJsonStructure([
                'status',
                'message',
            ]);
    }
}
