<?php

Route::get('/tipos_processos', [\App\Http\Controllers\TiposProcessos::class, 'index'])->name(
    'tipos_processos.index'
);
