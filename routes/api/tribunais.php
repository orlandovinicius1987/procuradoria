<?php

Route::group(['prefix' => '/tribunais'], function () {
    Route::get('/', [\App\Http\Controllers\Api\Tribunais::class, 'select'])->name('tribunais.select');
});
