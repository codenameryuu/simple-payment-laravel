<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PaymentApiController;

Route::group(
    [
        'as' => 'payment.',
        'middleware' => ['throttle:payment', 'auth:api'],
        'prefix' => 'payment',
    ],
    function () {
        Route::get('transaction/summary', [PaymentApiController::class, 'summaryTransaction'])
            ->name('summaryTransaction');

        Route::get('transaction/history/{user_id}', [PaymentApiController::class, 'historyTransaction'])
            ->name('historyTransaction');

        Route::post('transaction/create', [PaymentApiController::class, 'createTransaction'])
            ->name('createTransaction');

        Route::put('transaction/{transaction_id}', [PaymentApiController::class, 'updateTransaction'])
            ->name('updateTransaction');
    }
);
