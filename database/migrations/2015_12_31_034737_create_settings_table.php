<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->timestamps();
			$table->string('name', 255);
			$table->text('value');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}