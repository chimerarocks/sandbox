<?php

Route::group(['prefix' => 'categories', 'namespace' => 'ChimeraRocks\Category\Controllers'], function() {

	Route::get('test', 'AdminCategoryController@index');
	
});