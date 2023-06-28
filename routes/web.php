<?php

use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

Route::get('{data?}', [MyController::class, 'index'])
->name('test');