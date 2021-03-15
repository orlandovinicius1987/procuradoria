<?php

Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'Users@select')->name('users.select');
});

Route::get('/assessores', [\App\Http\Controllers\Api\Users::class, 'selectAdvisorOptions'])->name(
    'usuarios.selectAdvisorOptions'
);

Route::get('/estagiarios', [\App\Http\Controllers\Api\Users::class, 'selectInternOptions'])->name(
    'usuarios.selectInternOptions'
);

Route::get('/procuradores', [\App\Http\Controllers\Api\Users::class, 'selectAttorneyOptions'])->name(
    'usuarios.selectAttorneyOptions'
);
