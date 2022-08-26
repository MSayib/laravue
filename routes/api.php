<?php

use App\Http\Controllers\Post\PostController;
use Illuminate\Support\Facades\Route;

Route::prefix('post')->namespace('Post')->group(function () {
    Route::post('create-new-post', [PostController::class, 'store']);
});
