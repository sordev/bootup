<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectsTable extends Migration {

	public function up()
	{
		Schema::create('projects', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->string('title', 255);
			$table->string('category_ids', 255);
			$table->integer('user_id');
			$table->string('team_members');
			$table->string('image', 255);
			$table->text('intro');
			$table->text('detail');
			$table->string('video');
			$table->boolean('featured');
			$table->tinyInteger('status');
			$table->string('slug', 255);
		});
	}

	public function down()
	{
		Schema::drop('projects');
	}
}