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
		$this->call('Categories');
		$this->call('Content');
		Model::reguard();
	}
}