<?php

Route::group(['prefix' => '/tribunais'], function () {
    //INDEX
    Route::get('/', [\App\Http\Controllers\Tribunais::class, 'index'])->name('tribunais.index');

    //Create and Store
    Route::get('/create', [\App\Http\Controllers\Tribunais::class, 'create'])->name(
        'tribunais.create'
    );
    Route::post('/', [\App\Http\Controllers\Tribunais::class, 'store'])->name('tribunais.store');

    //show
    Route::get('/{id}', [\App\Http\Controllers\Tribunais::class, 'show'])->name('tribunais.show');
});
