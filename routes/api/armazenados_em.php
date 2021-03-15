<?php

Route::get('/armazenados_em', [\App\Http\Controllers\Api\ArmazenadosEm::class, 'select'])->name(
    'armazenados_em.select'
);
