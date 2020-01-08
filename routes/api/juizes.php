<?php

Route::group(['prefix' => '/juizes'], function () {
    Route::get('/', 'Juizes@select')->name('juizes.select');
});

Route::group(['prefix' => '/tiposjuizes'], function () {
    Route::get('/', 'TiposJuizes@select')->name('tipos_juizes.select');
});
