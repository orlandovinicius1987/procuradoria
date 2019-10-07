<?php

Route::group(['prefix' => '/pareceres'], function () {
    Route::get('/create', 'Opinions@create')->name('opinions.create');

    Route::post('/', 'Opinions@store')->name('opinions.store');

    Route::post('/{id}', 'Opinions@update')->name('opinions.update');

    Route::get('/{id}', 'Opinions@show')->name('opinions.show');

    Route::get('/{id}/{fileExtension}', 'Opinions@download')->name(
        'opinions.download'
    );

    Route::get('/', 'Opinions@index')->name('opinions.index');

    Route::post(
        '/relacionar-assunto/{opinion_id}',
        'Opinions@relacionarAssunto'
    )->name('opinions.relacionar-assunto');
});

Route::group(['prefix' => '/assuntos'], function () {
    Route::get('/create', 'OpinionSubjects@create')->name(
        'opinionSubjects.create'
    );

    Route::post('/', 'OpinionSubjects@store')->name('opinionSubjects.store');

    Route::post('/{id}', 'OpinionSubjects@update')->name(
        'opinionSubjects.update'
    );

    Route::get('/{id}', 'OpinionSubjects@show')->name('opinionSubjects.show');

    Route::get('/', 'OpinionSubjects@index')->name('opinionSubjects.index');

    Route::group(['prefix' => '/json'], function () {
        Route::get('/tree', 'OpinionSubjects@jsonTree')->name(
            'opinionsubjects.jsontree'
        );
        Route::get('/array', 'OpinionSubjects@jsonArray')->name(
            'opinionsubjects.jsonarray'
        );
    });
});
