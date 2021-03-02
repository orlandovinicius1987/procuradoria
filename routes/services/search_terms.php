<?php

Route::group(['prefix' => '/termos'], function () {
    //INDEX
    Route::get('/', [\App\Http\Controllers\SearchTerms::class, 'index'])->name(
        'search_terms.index'
    );

    //Create and Store
    Route::get('/create', [\App\Http\Controllers\SearchTerms::class, 'create'])->name(
        'search_terms.create'
    );
    Route::post('/', [\App\Http\Controllers\SearchTerms::class, 'store'])->name(
        'search_terms.store'
    );

    //show
    Route::get('/{id}', [\App\Http\Controllers\SearchTerms::class, 'show'])->name(
        'search_terms.show'
    );
});
