<?php

Route::group([
	'prefix' => 'admin/categories', 
	'namespace' => 'ChimeraRocks\Category\Controllers',
	'as' => 'admin.categories.',
	'middleware' => ['web']
	], function() {
	Route::get('/', ['uses' => 'AdminCategoryController@index', 'as' => 'index']);
	Route::get('/create', ['uses' => 'AdminCategoryController@create', 'as' => 'create']);
	Route::post('/store', ['uses' => 'AdminCategoryController@store', 'as' => 'store']);
	
});