<?php

use Illuminate\Database\Seeder;

class Categories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('categories')->insert([
			['title'=>'Хуудсууд','slug'=>'pages','type'=>2],
			['title'=>'Блог','slug'=>'blog','type'=>2],
			['title'=>'Вэбсайт','slug'=>'website','type'=>1],
			['title'=>'Аппликэшн','slug'=>'application','type'=>1],
			['title'=>'Видео тоглоом','slug'=>'veideogame','type'=>1],
			['title'=>'Программ хангам','slug'=>'software','type'=>1],
		]);
    }
}
