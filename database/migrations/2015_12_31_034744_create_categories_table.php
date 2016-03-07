<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('categories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('position');
			$table->timestamps();
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->string('description', 255);
			$table->string('type', 255);
		});
	}

	public function down()
	{
		Schema::drop('categories');
	}
}