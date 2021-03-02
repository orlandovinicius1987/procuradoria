<?php

Route::get('/tags', [\App\Http\Controllers\Tags::class, 'select'])->name('tags.select');
