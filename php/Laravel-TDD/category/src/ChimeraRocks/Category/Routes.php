<?php

Route::group([
	'prefix' => 'admin/categories', 
	'namespace' => 'ChimeraRocks\Category\Controllers',
	'as' => 'admin.categories.',
	], function() {
	Route::get('/', ['uses' => 'AdminCategoryController@index', 'as' => 'index']);
	Route::get('/create', ['uses' => 'AdminCategoryController@create', 'as' => 'create']);
	
});