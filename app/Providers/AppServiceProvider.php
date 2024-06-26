<?php

/**
 * (ɔ) GrCOTE7 - 1990-2024
 */

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void
	{
		Blade::if('admin', function () {
			return auth()->check() && auth()->user()->admin;
		});

		Blade::if('adminOrOwner', function ($id) {
			return auth()->check() && (auth()->id() === $id || auth()->user()->admin);
		});
	}
}