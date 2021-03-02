<?php

Route::get('/tipos_andamentos', [\App\Http\Controllers\TiposAndamentos::class, 'index'])->name(
    'tipos_andamentos.index'
);
