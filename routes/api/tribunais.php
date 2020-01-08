<?php

Route::group(['prefix' => '/tribunais'], function () {
    Route::get('/', 'Tribunais@select')->name('tribunais.select');
});
