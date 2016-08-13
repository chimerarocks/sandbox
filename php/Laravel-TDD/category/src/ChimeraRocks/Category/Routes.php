<?php

Route::group(['prefix' => 'categories'], function() {

	Route::get('test', function() {
		return "Test";
	});
	
});