<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Http\Controllers\Tutos\Sillo\FilmController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
	return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {
	Route::apiResource('films', FilmController::class);
});
