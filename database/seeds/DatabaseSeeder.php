<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	public function run()
	{
		Model::unguard();
		$this->call('Settings');
		$this->call('Roles');
		$this->call('CategoryTypes');
		$this->call('ContentTypes');
		$this->call('CommentTypes');
		$this->call('Categories');
		$this->call('Content');
		$this->call('Projects');
		$this->call('Users');
		$this->call('Blogs');
		Model::reguard();
	}
}