<?php

use Illuminate\Database\Seeder;

class CommentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('comment_types')->insert([
			['title'=>'Төсөл','slug'=>'project'],
			['title'=>'Агуулга','slug'=>'content'],
			['title'=>'Блог','slug'=>'blog'],
			['title'=>'Төслийн шинэчилэл','slug'=>'updates'],
		]);
    }
}
