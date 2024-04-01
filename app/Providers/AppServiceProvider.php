<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Providers;

use App\Models\Actor;
use App\Models\Category;
use App\Models\Film;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		$this->app->bind(
			'App\Repositories\PhotosRepositoryInterface',
			'App\Repositories\PhotosRepository'
		);
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
        setlocale(LC_TIME, config('app.locale'));

		View::composer(['pages.tuto.film.index', 'pages.tuto.film.create', 'pages.tuto.film.edit'], function ($view) {
			$view->with('categories', Category::all())
				->with('actors', Actor::all());
		});

		// Route::bind('film', function ($value) {
		// 	return Film::with('categories', 'actors')->find($value);
		// });
	}
}
