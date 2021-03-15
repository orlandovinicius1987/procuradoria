<?php

Route::get('/tipos_processos', [\App\Http\Controllers\Api\TiposProcessos::class, 'select'])->name(
    'tipos_processos.select'
);
