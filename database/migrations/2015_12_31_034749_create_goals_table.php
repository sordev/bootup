<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGoalsTable extends Migration {

	public function up()
	{
		Schema::create('goals', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('project_id')->unsigned();
			$table->string('title', 255);
			$table->date('start');
			$table->date('end');
			$table->integer('phase');
			$table->string('description', 255);
			$table->decimal('goal', 10,2);
		});
	}

	public function down()
	{
		Schema::drop('goals');
	}
}