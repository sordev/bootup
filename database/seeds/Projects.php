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
			for ($i=0;$i<10;$i++){
				$u->goal()->save(factory(App\Goal::class)->make());
				$u->reward()->save(factory(App\Reward::class)->make());
				$u->payment()->save(factory(App\Payment::class)->make());
			}
		});
    }
}
