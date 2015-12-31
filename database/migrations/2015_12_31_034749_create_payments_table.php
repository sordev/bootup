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
			$table->decimal('value', 10,2);
			$table->string('user_id');
			$table->string('gateway');
		});
	}

	public function down()
	{
		Schema::drop('payments');
	}
}