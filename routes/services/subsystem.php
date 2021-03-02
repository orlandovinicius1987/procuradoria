<?php

Route::group(['prefix' => '/subsystem'], function () {
    Route::get('/', [\App\Http\Controllers\Subsystem::class, 'index'])->name('subsystem.index');

    Route::get('/select/{subsystem}', [\App\Http\Controllers\Subsystem::class, 'select'])->name(
        'subsystem.select'
    );
});
