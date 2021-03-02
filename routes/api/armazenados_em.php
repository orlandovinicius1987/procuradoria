<?php

Route::get('/armazenados_em', [\App\Http\Controllers\ArmazenadosEm::class, 'select'])->name(
    'armazenados_em.select'
);
