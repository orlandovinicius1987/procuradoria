<?php

Route::group(['prefix' => '/revisions'], function () {
    Route::get('/', [\App\Http\Controllers\Revisions::class, 'index'])->name('revisions.index');

    Route::get('/{id}', [\App\Http\Controllers\Revisions::class, 'show'])->name('revisions.show');
});
