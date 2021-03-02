<?php

Route::get('/tipos_andamentos', [\App\Http\Controllers\TiposAndamentos::class, 'select'])->name(
    'tipos_andamentos.select'
);
