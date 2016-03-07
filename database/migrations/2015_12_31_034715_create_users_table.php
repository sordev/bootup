<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->timestamps();
			$table->string('username', 30);
			$table->string('email', 100);
			$table->string('password', 100);
			$table->string('salt', 30);
			$table->string('register_ip', 15);
			$table->string('forget_token', 100)->nullable();
			$table->string('registered_with', 100)->nullable();
			$table->rememberToken();
			$table->string('active_token', 100)->nullable();
			$table->tinyInteger('public');
			$table->tinyInteger('status');
			$table->tinyInteger('role');
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->string('avatar', 255);
			$table->text('bio');
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}