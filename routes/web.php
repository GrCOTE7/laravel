<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TestController;

Route::get('/', [MyController::class, 'index'])
	->name('test');
Route::get('users', [MyController::class, 'users'])
	->name('users');
Route::get('mail', [MailController::class, 'index'])
	->name('mail');
Route::post('mail', [MailController::class, 'send']);
Route::get('test', [TestController::class, 'index'])
	->name('test.index');
Route::post('test', [TestController::class, 'store']);

use Illuminate\Support\Facades\Route;

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);