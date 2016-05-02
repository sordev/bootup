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
        factory(App\Content::class, 30)->create();
    }
}
