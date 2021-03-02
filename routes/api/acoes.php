<?php

Route::group(['prefix' => '/acoes'], function () {
    Route::get('/', [\App\Http\Controllers\Acoes::class, 'select'])->name('acoes.select');
});
