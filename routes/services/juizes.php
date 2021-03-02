<?php

Route::group(['prefix' => '/juizes'], function () {
    Route::get('/create', [\App\Http\Controllers\Juizes::class, 'create'])->name('juizes.create');

    Route::post('/', [\App\Http\Controllers\Juizes::class, 'store'])->name('juizes.store');

    Route::get('/', [\App\Http\Controllers\Juizes::class, 'index'])->name('juizes.index');

    Route::get('/{id}', [\App\Http\Controllers\Juizes::class, 'show'])->name('juizes.show');

    Route::get('/', [\App\Http\Controllers\Juizes::class, 'index'])->name('juizes.index');
});

Route::group(['prefix' => '/tiposjuizes'], function () {
    Route::get('/', [\App\Http\Controllers\TiposJuizes::class, 'create'])->name(
        'tipos_juizes.create'
    );

    Route::post('/', [\App\Http\Controllers\TiposJuizes::class, 'store'])->name(
        'tipos_juizes.store'
    );
});
