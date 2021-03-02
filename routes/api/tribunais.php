<?php

Route::group(['prefix' => '/tribunais'], function () {
    Route::get('/', [\App\Http\Controllers\Tribunais::class, 'select'])->name('tribunais.select');
});
