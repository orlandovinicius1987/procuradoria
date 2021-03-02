<?php

Route::get('/meios', [\App\Http\Controllers\Meios::class, 'index'])->name('meios.index');
