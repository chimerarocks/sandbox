<?php

namespace ChimeraRocks\Category\Models;

class Category extends Models
{
	protected $table = "chimerarocks_categories";

	protected $fillable = [
		'name',
		'active',
		'parent_id'
	];
}