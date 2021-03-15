<?php

Route::group(['prefix' => '/acoes'], function () {
    Route::get('/', [\App\Http\Controllers\Api\Acoes::class, 'select'])->name('acoes.select');
});
