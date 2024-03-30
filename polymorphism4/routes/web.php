<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\FilmController; 

Route::resource('films', FilmController::class);

Route::controller(FilmController::class)->group(function () {
    Route::delete('films/force/{id}', 'forceDestroy')->name('films.force.destroy');
    Route::put('films/restore/{id}', 'restore')->name('films.restore');
    Route::get('category/{slug}/films', 'index')->name('films.category');
    Route::get('actor/{slug}/films', 'index')->name('films.actor');
});

Route::get('/', function () {
    return view('welcome');
});
