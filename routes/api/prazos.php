<?php

Route::group(['prefix' => '/tipos_prazos'], function () {
    Route::get('/', [\App\Http\Controllers\Api\TiposPrazos::class, 'select'])->name(
        'tipos_prazos.select'
    );
});
