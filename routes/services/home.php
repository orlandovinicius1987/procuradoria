<?php

Route::get('/', [\App\Http\Controllers\Home::class, 'index'])->name('home.index');

Route::post('/', [\App\Http\Controllers\Home::class, 'filter'])->name('home.filter');
