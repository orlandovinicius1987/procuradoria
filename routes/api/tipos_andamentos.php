<?php

Route::get('/tipos_andamentos', [\App\Http\Controllers\Api\TiposAndamentos::class, 'select'])->name(
    'tipos_andamentos.select'
);
