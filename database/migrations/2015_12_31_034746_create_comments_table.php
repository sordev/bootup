<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id')->nullable();
			$table->integer('reply_id')->nullable();
			$table->integer('item_id')->nullable();
			$table->tinyInteger('type');
			$table->text('comment');
			$table->tinyInteger('status');
			$table->string('ip', 15);
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}