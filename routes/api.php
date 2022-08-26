<?php

use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\Note\SubjectController;
use Illuminate\Support\Facades\Route;

Route::namespace('Note')->group(function () {
    Route::prefix('note')->group(function () {
        Route::post('create-new-note', [NoteController::class, 'store']);
    });

    Route::prefix('subject')->group(function () {
        Route::get('', [SubjectController::class, 'index']);
    });
});
