<?php

use LantosBro\OAuth2\Http\Controllers\AuthorisationController;

Route::middleware(['web'])->group(function () {

    Route::get(
        'oauth2/{integration}/authorise',
        [AuthorisationController::class, 'create']
    )->name('oauth2.authorise');

    Route::get(
        'oauth2/{integration}/callback',
        [AuthorisationController::class, 'store']
    )->name('oauth2.callback');
});
