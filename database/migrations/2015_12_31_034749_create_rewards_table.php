<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRewardsTable extends Migration {

	public function up()
	{
		Schema::create('rewards', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('project_id')->unsigned();
			$table->string('title', 255);
			$table->decimal('value', 10,2);
			$table->string('image');
			$table->string('description');
			$table->string('amount');
			$table->date('estimated_date');
		});
	}

	public function down()
	{
		Schema::drop('rewards');
	}
}