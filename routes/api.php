<?php

use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\Note\SubjectController;
use Illuminate\Support\Facades\Route;

Route::namespace('Note')->group(function () {
    Route::prefix('note')->group(function () {
        Route::get('', [NoteController::class, 'index']);
        // Contoh Bisa juga : {subject:id}/{note:slug} tapi harus nambah di controller function(Subject $subject, Note $note)
        Route::get('{catatan:slug}', [NoteController::class, 'show'])->name('note.show');
        Route::post('create-new-note', [NoteController::class, 'store']);
    });

    Route::prefix('subject')->group(function () {
        Route::get('', [SubjectController::class, 'index']);
    });
});
