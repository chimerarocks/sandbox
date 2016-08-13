<?php

namespace ChimeraRocks\Tag\Providers;

use Illuminate\Support\ServiceProvider;

class TagServiceProvider extends ServiceProvider
{

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../../resources/migrations/' => base_path('database/migrations')
			],'migrations');

		require_once __DIR__ . '/../Routes.php';
	}

	/**
     * Register the service provider.
     *
     * @return void
     */
	public function register()
	{
		//Todo
	}
}