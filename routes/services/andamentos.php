<?php

Route::group(['prefix' => '/andamentos'], function () {
    Route::get('/create/{id?}', [\App\Http\Controllers\Andamentos::class, 'create'])->name(
        'andamentos.create'
    );

    Route::post('/create', [\App\Http\Controllers\Andamentos::class, 'create_post'])->name(
        'andamentos.create_post'
    );

    Route::post('/', [\App\Http\Controllers\Andamentos::class, 'store'])->name('andamentos.store');

    Route::get('/', [\App\Http\Controllers\Andamentos::class, 'index'])->name('andamentos.index');

    Route::get('/{id}', [\App\Http\Controllers\Andamentos::class, 'show'])->name('andamentos.show');
});
