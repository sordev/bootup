<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLogsTable extends Migration {

	public function up()
	{
		Schema::create('logs', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('request');
			$table->text('response');
			$table->string('type');
			$table->integer('project_id');
		});
	}

	public function down()
	{
		Schema::drop('logs');
	}
}