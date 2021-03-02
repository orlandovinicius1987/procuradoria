<?php

Route::get('/armazenados_em', [\App\Http\Controllers\ArmazenadosEm::class, 'index'])->name(
    'armazenados_em.index'
);
