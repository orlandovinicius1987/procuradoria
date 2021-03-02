<?php

Route::get('/tipos_processos', [\App\Http\Controllers\TiposProcessos::class, 'select'])->name(
    'tipos_processos.select'
);
