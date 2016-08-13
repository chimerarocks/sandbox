<?php

namespace ChimeraRocks\Category\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider
{

	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../../resources/migrations/' => 
				base_path('database/migrations')]
			, 'migrations');
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