<?php

use Illuminate\Database\Seeder;

class Blogs extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Content::class, 30)->create()
		->each(function($u) {
			$max = rand(5,20);
			for ($i=0;$i<$max;$i++){
				$u->comment()->save(factory(App\Comment::class)->make([
					'type'=>3
				]));
			}
		});
    }
}
