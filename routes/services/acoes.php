<?php

Route::group(['prefix' => '/acoes'], function () {
    Route::get('/create', [\App\Http\Controllers\Acoes::class, 'create'])->name('acoes.create');

    Route::post('/', [\App\Http\Controllers\Acoes::class, 'store'])->name('acoes.store');

    Route::get('/{id}', [\App\Http\Controllers\Acoes::class, 'show'])->name('acoes.show');

    Route::get('/', [\App\Http\Controllers\Acoes::class, 'index'])->name('acoes.index');
});
