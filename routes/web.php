<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Http\classes\ExportManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use App\Http\Controllers\GregController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\WelcomeController;

// Route::get('/t2', function () {
// 	return phpinfo();
// });

Route::get('/', [MyController::class, 'index'])
	->name('test');
Route::get('/w', [WelcomeController::class, 'index'])
	->name('welcome');

Route::get('greg', [GregController::class, 'index'])
	->name('greg');

Route::get('users', [MyController::class, 'users'])
	->name('users');
Route::get('mail', [MailController::class, 'index'])
	->name('mail');
Route::post('mail', [MailController::class, 'send']);
Route::get('test', [TestController::class, 'monospace'])
	->name('test.monospace');
// Route::get('test2', function(){
//     return response('Un test', 206)->header('Content-Type', 'text/plain');
// });

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);

Route::get('export', [ExportManager::class, 'index'])->name('export.index');
Route::get('files', [ExportManager::class, 'files'])->name('export.files');

function aff($message)
{
	echo $message;
	ob_flush();
	flush();
}
