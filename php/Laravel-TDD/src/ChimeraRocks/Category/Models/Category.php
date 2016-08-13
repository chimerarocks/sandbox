<?php

namespace ChimeraRocks\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Models
{
	protected $table = "chimerarocks_categories";

	protected $fillable = [
		'name',
		'active',
		'parent_id'
	];
}