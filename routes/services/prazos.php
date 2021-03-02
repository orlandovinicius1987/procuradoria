<?php

Route::group(['prefix' => '/tipos_prazos'], function () {
    Route::get('/', [\App\Http\Controllers\TiposPrazos::class, 'create'])->name(
        'tipos_prazos.create'
    );

    Route::post('/', [\App\Http\Controllers\TiposPrazos::class, 'store'])->name(
        'tipos_prazos.store'
    );
});
