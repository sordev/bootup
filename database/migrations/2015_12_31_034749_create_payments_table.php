<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration {

	public function up()
	{
		Schema::create('payments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('project_id')->unsigned();
			$table->integer('reward_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->decimal('value', 10,2);
			$table->string('gateway');
			$table->string('note');
			$table->tinyInteger('status');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}