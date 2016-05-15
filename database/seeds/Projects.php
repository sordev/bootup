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
		->each(function($project) {
			$max = rand(5,10);
			for ($i=0;$i<$max;$i++){
				$project->goal()->save(factory(App\Goal::class)->make());
			}
			$max = rand(5,10);
			for ($i=0;$i<$max;$i++){
				$project->reward()->save(factory(App\Reward::class)->make());
			}
			$max = rand(5,20);
			for ($i=0;$i<$max;$i++){
				$project->payment()->save(factory(App\Payment::class)->make());
			}
			$max = rand(5,20);
			for ($i=0;$i<$max;$i++){
				$project->comment()->save(factory(App\Comment::class)->make([
					'type'=>1
				]));
			}
			$max = rand(5,20);
			for ($i=0;$i<$max;$i++){
				$project->updates()->save(factory(App\Content::class)->make([
					'type'=>3
					]));
			}
		});
		
		$payments = App\Payment::where('value',0)->get();
		foreach($payments as $p){
			$project = App\Project::find($p->project_id);
			$reward = $project->reward()->orderBy(DB::raw('RAND()'))->take(1)->first();
			$p->value = $reward->value;
			$p->reward_id = $reward->id;
			$p->save();
		}
		
		$comments = App\Comment::where('type',1)->where('reply_id',1)->get();
		foreach($comments as $c){
			$parents = App\Comment::where('type',1)->where('item_id',$c->item_id)->orderByRaw(("RAND()"))->first();
			if($parents){
				$c->reply_id = $parents->id;
				$c->save();
			}
		}
    }
}
