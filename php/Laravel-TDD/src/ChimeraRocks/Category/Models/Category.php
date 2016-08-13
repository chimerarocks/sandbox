<?php

namespace ChimeraRocks\Category\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = "chimerarocks_categories";

	protected $fillable = [
		'name',
		'active',
		'parent_id'
	];

	public function parent()
	{
		return $this->belongsTo(Category::class);
	}

	public function children()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}
}