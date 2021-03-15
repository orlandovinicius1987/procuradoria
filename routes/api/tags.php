<?php

Route::get('/tags', [\App\Http\Controllers\Api\Tags::class, 'select'])->name('tags.select');
