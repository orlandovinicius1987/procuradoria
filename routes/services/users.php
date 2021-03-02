<?php

Route::group(['prefix' => '/users'], function () {
    Route::get('/', [\App\Http\Controllers\Users::class, 'index'])->name('users.index');

    Route::get('/{id}/enable', [\App\Http\Controllers\Users::class, 'enable'])->name(
        'users.enable'
    );

    Route::get('/{id}/disable', [\App\Http\Controllers\Users::class, 'disable'])->name(
        'users.disable'
    );

    Route::post('/', [\App\Http\Controllers\Users::class, 'store'])->name('users.store');

    //show
    Route::get('/{id}', [\App\Http\Controllers\Users::class, 'show'])->name('users.show');
});

Route::get('/assessores', [\App\Http\Controllers\Users::class, 'assessores'])->name(
    'usuarios.assessores'
);

Route::get('/estagiarios', [\App\Http\Controllers\Users::class, 'estagiarios'])->name(
    'usuarios.estagiarios'
);

Route::get('/procuradores', [\App\Http\Controllers\Users::class, 'procuradores'])->name(
    'usuarios.procuradores'
);
