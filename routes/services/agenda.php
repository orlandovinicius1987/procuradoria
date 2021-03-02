<?php

Route::group(['prefix' => '/agenda'], function () {
    Route::get('/', [\App\Http\Controllers\Agenda::class, 'index'])->name('agenda.index');

    Route::get('/feed', [\App\Http\Controllers\Agenda::class, 'feed'])->name('agenda.feed');
});
