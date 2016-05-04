<?php

use Illuminate\Database\Seeder;

class ContentTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content_types')->insert([
			['title'=>'Хуудас','uniqid'=>'page'],
			['title'=>'Блог','uniqid'=>'blog'],
			['title'=>'Төслийн шинэчилэл','uniqid'=>'updates'],
		]);
    }
}
