<?php

Route::group(['prefix' => '/users'], function () {
    Route::get('/', 'Users@select')->name('users.select');
});

Route::get('/assessores', 'Users@selectAdvisorOptions')->name(
    'usuarios.selectAdvisorOptions'
);

Route::get('/estagiarios', 'Users@selectInternOptions')->name(
    'usuarios.selectInternOptions'
);

Route::get('/procuradores', 'Users@selectAttorneyOptions')->name(
    'usuarios.selectAttorneyOptions'
);
