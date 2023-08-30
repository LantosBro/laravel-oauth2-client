<?php

Route::middleware(['web'])->group(function () {
    Route::get(
        'oauth2/{integration}/authorise',
        'LantosBro\OAuth2\Http\Controllers\AuthorisationController@create'
    )->name('oauth2.authorise');

	// add American authorize route
    Route::get(
        'oauth2/{integration}/authorize',
        'LantosBro\OAuth2\Http\Controllers\AuthorisationController@create'
    )->name('oauth2.authorize');

    Route::get(
        'oauth2/{integration}/callback',
        'LantosBro\OAuth2\Http\Controllers\AuthorisationController@store'
    )->name('oauth2.callback');
});
