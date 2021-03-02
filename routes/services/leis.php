<?php

Route::group(['prefix' => '/leis'], function () {
    Route::get('/create/{processo_id?}', [\App\Http\Controllers\Leis::class, 'create'])->name(
        'leis.create'
    );

    Route::post('/', [\App\Http\Controllers\Leis::class, 'store'])->name('leis.store');

    Route::get('/', [\App\Http\Controllers\Leis::class, 'index'])->name('leis.index');

    Route::get('/{id}', [\App\Http\Controllers\Leis::class, 'show'])->name('leis.show');
});
