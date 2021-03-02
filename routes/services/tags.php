<?php

Route::get('/tags', [\App\Http\Controllers\Tags::class, 'index'])->name('tags.index');
