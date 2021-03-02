<?php

Route::group(['prefix' => '/processos'], function () {
    //www.procuradoria.test/processos
    //Index

    //Create and Store
    Route::get('/', [\App\Http\Controllers\Processos::class, 'create'])->name('processos.create');
    Route::post('/', [\App\Http\Controllers\Processos::class, 'store'])->name('processos.store');

    // Search and Detail
    Route::get('/search', [\App\Http\Controllers\Processos::class, 'search'])->name(
        'processos.search'
    );

    //    Route::post('/resultSearch', [\App\Http\Controllers\Processos::class,'resultSearch'])->name('processos.resultSearch');

    //    Route::get('/resultSearch', [\App\Http\Controllers\Processos::class,'search'])->name('processos.search');

    Route::get('/{id}', [\App\Http\Controllers\Processos::class, 'show'])->name('processos.show');

    Route::get('/{id}/download', [\App\Http\Controllers\Processos::class, 'download'])->name(
        'processos.download'
    );

    Route::post('/apensar', [\App\Http\Controllers\Processos::class, 'apensar'])->name(
        'processos.apensar'
    );

    Route::post('/relacionarLei', [\App\Http\Controllers\Processos::class, 'relacionarLei'])->name(
        'processos.relacionarLei'
    );
});

// "name" serve pra atender o método route do Laravel no HTML. Vide : /resource/view/processos/form.blade.php
//exemplo {{ route('processos.create') }}
