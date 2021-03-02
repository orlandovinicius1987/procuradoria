<?php

Route::group(['prefix' => '/buscas'], function () {
    Route::get('/', 'Buscas@index')->name('buscas.index');

    Route::get('/{id}/import', [\App\Http\Controllers\Buscas::class, 'import'])->name(
        'buscas.import'
    );

    Route::get('/{id}/ignore', [\App\Http\Controllers\Buscas::class, 'ignore'])->name(
        'buscas.ignore'
    );
});
