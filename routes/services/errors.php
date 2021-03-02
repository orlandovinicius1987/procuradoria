<?php

Route::group(['prefix' => '/errors'], function () {
    Route::get('/user-disabled', [\App\Http\Controllers\Errors::class, 'userDisabled'])->name(
        'errors.user-disabled'
    );
});
