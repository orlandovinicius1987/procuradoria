<?php

Route::get('/meios', [\App\Http\Controllers\Meios::class, 'select'])->name('meios.select');
