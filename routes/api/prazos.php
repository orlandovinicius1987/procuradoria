<?php

Route::group(['prefix' => '/tipos_prazos'], function () {
    Route::get('/', [\App\Http\Controllers\TiposPrazos::class, 'select'])->name(
        'tipos_prazos.select'
    );
});
