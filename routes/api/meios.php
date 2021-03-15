<?php

Route::get('/meios', [\App\Http\Controllers\Api\Meios::class, 'select'])->name('meios.select');
