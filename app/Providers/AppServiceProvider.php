<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Providers;

use App\Models\Category;
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
		View::composer(['pages.tuto.film.index', 'pages.tuto.film.create'], function ($view) {
			$view->with('categories', Category::all());
		});
	}
}
