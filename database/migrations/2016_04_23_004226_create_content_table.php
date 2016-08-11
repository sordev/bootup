<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function(Blueprint $table) {
			$table->increments('id');
			$table->tinyInteger('category_id')->unsigned()->index();
			$table->tinyInteger('type')->unsigned()->index();
			$table->string('title', 255);
			$table->string('slug', 255)->unique();
			$table->string('description', 255)->nullable();
			$table->text('summary');
			$table->text('content');
			$table->enum('status', array('draft', 'publish'))->index();
			$table->boolean('comments')->index();
			$table->boolean('featured')->index();
			$table->boolean('showinfo')->index();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('user_id');
		});
        Schema::create('content_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 255);
			$table->string('uniqid', 255)->unique();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contents');
        Schema::drop('content_types');
    }
}
