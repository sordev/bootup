<?php

use Illuminate\Database\Seeder;

class Content extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert([
			['category_id'=>'1','type'=>'1','title'=>'Бидний тухай','slug'=>'about-us','content'=>'Бидний тухай агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'Хамтран ажиллагсад','slug'=>'about-partners','content'=>'Хамтран ажиллагсад агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'Дэмжигчид','slug'=>'about-supporters','content'=>'Дэмжигчид агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'FAQ Асуулт хариулт','slug'=>'faq','content'=>'Асуулт хариултын агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'Төслийн шалгуур','slug'=>'requirment','content'=>'Асуулт хариултын агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'Хөрөнгө оруулах','slug'=>'funding','content'=>'Асуулт хариултын агуулга','status'=>'publish','user_id'=>1],
			['category_id'=>'1','type'=>'1','title'=>'Үйлчилгээний нөхцөл','slug'=>'tos','content'=>'Асуулт хариултын агуулга','status'=>'publish','user_id'=>1],
		]);
    }
}
