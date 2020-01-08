<?php

Route::group(['prefix' => '/tipos_prazos'], function () {
    Route::get('/', 'TiposPrazos@select')->name('tipos_prazos.select');
});
