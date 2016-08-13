<?php

namespace ChimeraRocks\Category\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Cviebrock\EloquentSluggable\SluggableInterface;

class Category extends Model implements SluggableInterface
{
	use SluggableTrait;

	protected $table = "chimerarocks_categories";

	protected $sluggable = [
		'build_from' => 'name',
		'save_to' => 'slug',
		'unique' => 'true'
	];

	protected $fillable = [
		'slug',
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

	public function categorizable()
	{
		return $this->morphTo();
	}
}