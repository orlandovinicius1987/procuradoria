<?php

Route::group(['prefix' => '/pareceres'], function () {
    Route::get('/create', [\App\Http\Controllers\Opinions::class, 'create'])->name(
        'opinions.create'
    );

    Route::post('/', [\App\Http\Controllers\Opinions::class, 'store'])->name('opinions.store');

    Route::post('/{id}', [\App\Http\Controllers\Opinions::class, 'update'])->name(
        'opinions.update'
    );

    Route::get('/{id}', [\App\Http\Controllers\Opinions::class, 'show'])->name('opinions.show');

    Route::get('/{id}/{fileExtension}', [\App\Http\Controllers\Opinions::class, 'download'])->name(
        'opinions.download'
    );

    Route::get('/', [\App\Http\Controllers\Opinions::class, 'index'])->name('opinions.index');

    Route::post('/relacionar-assunto/{opinion_id}', [
        \App\Http\Controllers\Opinions::class,
        'relacionarAssunto',
    ])->name('opinions.relacionar-assunto');
});

Route::group(['prefix' => '/assuntos'], function () {
    Route::get('/create', [\App\Http\Controllers\OpinionSubjects::class, 'create'])->name(
        'opinionSubjects.create'
    );

    Route::post('/', [\App\Http\Controllers\OpinionSubjects::class, 'store'])->name(
        'opinionSubjects.store'
    );

    Route::post('/{id}', [\App\Http\Controllers\OpinionSubjects::class, 'update'])->name(
        'opinionSubjects.update'
    );

    Route::get('/{id}', [\App\Http\Controllers\OpinionSubjects::class, 'show'])->name(
        'opinionSubjects.show'
    );

    Route::get('/', [\App\Http\Controllers\OpinionSubjects::class, 'index'])->name(
        'opinionSubjects.index'
    );

    Route::group(['prefix' => '/json'], function () {
        Route::get('/tree/{selectedId?}', [
            \App\Http\Controllers\OpinionSubjects::class,
            'jsonTree',
        ])->name('opinionsubjects.jsontree');
        Route::get('/array', [\App\Http\Controllers\OpinionSubjects::class, 'jsonArray'])->name(
            'opinionsubjects.jsonarray'
        );
    });
});
