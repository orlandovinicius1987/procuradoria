<?php

Route::group(['prefix' => '/juizes'], function () {
    Route::get('/', [\App\Http\Controllers\Api\Juizes::class, 'select'])->name('juizes.select');
});

Route::group(['prefix' => '/tiposjuizes'], function () {
    Route::get('/', [\App\Http\Controllers\TiposJuizes::class, 'select'])->name(
        'tipos_juizes.select'
    );
});
