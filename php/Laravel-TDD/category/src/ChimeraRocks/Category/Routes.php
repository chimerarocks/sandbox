<?php

Route::group(['prefix' => 'admin/categories', 'namespace' => 'ChimeraRocks\Category\Controllers'], function() {

	Route::get('', 'AdminCategoryController@index');
	
});