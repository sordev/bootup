<?php

use Illuminate\Database\Seeder;

class Projects extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\Project::class, 20)->create()
		->each(function($u) {
			$max = rand(5,10);
			for ($i=0;$i<$max;$i++){
				$u->goal()->save(factory(App\Goal::class)->make());
			}
			$max = rand(5,10);
			for ($i=0;$i<$max;$i++){
				$u->reward()->save(factory(App\Reward::class)->make());
			}
			$max = rand(5,10);
			for ($i=0;$i<$max;$i++){
				$u->payment()->save(factory(App\Payment::class)->make());
			}
		});
    }
}
