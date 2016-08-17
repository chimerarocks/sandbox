<?php

namespace Test\Stubs\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = "chimerarocks_categories";

	protected $fillable = [
		'name',
		'description'
	];
}