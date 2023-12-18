<?php

use App\Http\classes\ExportManager;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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
// Route::get('test2', function(){
//     return response('Un test', 206)->header('Content-Type', 'text/plain');
// });

Route::get('photo', [PhotoController::class, 'create']);
Route::post('photo', [PhotoController::class, 'store']);

Route::get('export', [ExportManager::class, 'index'])->name('export.index');
Route::get('files', [ExportManager::class, 'files'])->name('export.files');
