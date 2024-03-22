<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

use App\Http\Classes\ExportManager;
use App\Http\Controllers\LbcController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TutoController;
use App\Http\Controllers\UserController;
use App\Http\Tutos\Divers\GregController;
use App\Http\Tutos\Php\Poo;
use App\Http\Tutos\Sillo\ContactController;
use App\Http\Tutos\Sillo\MailController;
use App\Http\Tutos\Sillo\PhotoController;

date_default_timezone_set('Europe/Paris');

Route::get('/', [MyController::class, 'index'])
	->name('test');

Route::get('tuto', [TutoController::class, 'tutos'])
	->name('tuto.tutos');
// POO PHP
if (1) {
	Route::get('tuto/poo', [Poo::class, 'index']);
}

// Menu W: Tuto Sillo
if (1) {
	Route::get('direct-response', function () {
		return response('Un test', 206)->header('Content-Type', 'text/plain');
	});

	Route::get('tuto/article/{n}', [TutoController::class, 'article'])
		->where('n', '[0-9]+');

	Route::get('tuto/contact', [ContactController::class, 'create']);
	Route::post('tuto/contact', [ContactController::class, 'store']);

	Route::get('tuto/mail', [MailController::class, 'index'])
		->name('mail');
	Route::post('tuto/mail', [MailController::class, 'send']);
	Route::get('tuto/mail/view', [MailController::class, 'view']);

	Route::get('tuto/photo', [PhotoController::class, 'create']);
	Route::post('tuto/photo', [PhotoController::class, 'store']);
}
// Divers
if (1) {
	Route::get('tuto/greg', [GregController::class, 'index'])
		->name('greg');

	Route::get('tuto/welcome', [TutoController::class, 'welcome'])
		->name('welcome');
}
// LBC - Files & exports
if (2) {
	Route::get('lbc', [LbcController::class, 'index'])->name('lbc.index');

	Route::get('lbc/files', [ExportManager::class, 'getFiles'])->name('export.files');

	Route::get('lbc/export', [ExportManager::class, 'index'])->name('export.index');
}

Route::get('users', [UserController::class, 'create'])
	->name('users.index');
Route::post('users', [UserController::class, 'store'])
	->name('users.store');

Route::get('test', [TestController::class, 'index'])
	->name('test');
