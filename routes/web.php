<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Http\classes\ExportManager;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GregController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TutoSilloController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/t2', function () {
// 	return phpinfo();
// });

Route::get('/', [MyController::class, 'index'])
	->name('test');

Route::get('w', [TutoSilloController::class, 'index'])
	->name('w');
Route::get('w/welcome', [TutoSilloController::class, 'welcome'])
	->name('welcome');

Route::get('w/article/{n}', [TutoSilloController::class, 'article'])
	->where('n', '[0-9]+');

Route::get('w/mail', [MailController::class, 'index'])
	->name('mail');
Route::post('w/mail', [MailController::class, 'send']);
Route::get('/mail/view', [MailController::class, 'view']);

Route::get('w/greg', [GregController::class, 'index'])
	->name('greg');

Route::get('users', [UserController::class, 'create'])
	->name('users.index');
Route::post('users', [UserController::class, 'store'])
	->name('users.store');

Route::get('contact', [ContactController::class, 'create']);
Route::post('contact', [ContactController::class, 'store']);

Route::get('test', [TestController::class, 'monospace'])
	->name('test.monospace');
// Route::get('test2', function(){
//     return response('Un test', 206)->header('Content-Type', 'text/plain');
// });

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);

Route::get('export', [ExportManager::class, 'index'])->name('export.index');
Route::get('files', [ExportManager::class, 'files'])->name('export.files');
