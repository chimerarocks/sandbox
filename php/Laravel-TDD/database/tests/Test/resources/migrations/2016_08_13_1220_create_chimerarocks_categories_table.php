<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChimerarocksCategoriesTable
{
	public function up()
	{
		Schema::create('chimerarocks_categories', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('chimerarocks_categories');
	}
}