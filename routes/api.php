<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 * Tuto Sillo:
 * NB:
 * - Custom api resource:
 *   php artisan make:resource Film
 * - Users rights management with PassePort:
 *   php artisan install:api --passport
 */

use App\Http\Controllers\Api\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
// 	return $request->user();
// })->middleware('auth:sanctum');

Route::name('api.')->group(function () {
	Route::apiResource('films', FilmController::class);
});
