<?php

use Illuminate\Database\Seeder;

class CategoryTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_types')->insert([
			['title'=>'Project','slug'=>'projects'],
			['title'=>'Blog','slug'=>'blog'],
		]);
    }
}
