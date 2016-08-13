<?php

namespace ChimeraRocks\Tag\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $table = "chimerarocks_tags";

	protected $fillable = [
		'name',
	];

	public function taggable()
	{
		return $this->morphTo();
	}
}