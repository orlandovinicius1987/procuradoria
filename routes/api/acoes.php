<?php

Route::group(['prefix' => '/acoes'], function () {
    Route::get('/', 'Acoes@select')->name('acoes.select');
});
