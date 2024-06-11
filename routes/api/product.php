<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductApiController;

Route::group(
    [
        'as' => 'product.',
        'middleware' => [],
        'prefix' => 'product',
    ],
    function () {
        Route::get('', [ProductApiController::class, 'index'])
            ->name('index');

        Route::get('{product_id}', [ProductApiController::class, 'show'])
            ->name('show');

        Route::post('', [ProductApiController::class, 'create'])
            ->name('create');

        Route::put('{product_id}', [ProductApiController::class, 'update'])
            ->name('update');

        Route::delete('{product_id}', [ProductApiController::class, 'destroy'])
            ->name('destroy');
    }
);
