<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersSocialsTable extends Migration {

	public function up()
	{
		Schema::create('users_socials', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->timestamps();
			$table->string('social', 255);
			$table->string('socialname', 255);
		});
	}

	public function down()
	{
		Schema::drop('users_socials');
	}
}