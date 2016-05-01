<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$factory->define(App\Project::class, function (Faker\Generator $faker) {

	$size = rand(1,7);
	$teamArray = [];
	for($i=1;$i<=$size;$i++){
		$teamArray[] = rand(1,20);
	}
	array_unique($teamArray);
	$team_members = implode(',',$teamArray);

    return [
        'title' => $faker->text(30),
        'category_ids' => rand(3,6),
        'user_id' => rand(1,20),
        'intro' => $faker->text(),
        'detail' => $faker->text(),
		'status'=> 1,
		'slug' => $faker->word(),
		'featured' => rand(0,1),
		'image' => rand(1,3).'.jpg',
		'team_members' => $team_members,
    ];
});

$factory->define(App\Goal::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(30),
        'start' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'end' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 year', $timezone = date_default_timezone_get()),
        'phase' => rand(1,10),
        'description' => $faker->text(),
		'goal'=> $faker->randomNumber()
    ];
});

$factory->define(App\Reward::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(30),
		'value'=> $faker->randomNumber(),
		'description' => $faker->text(),
        'amount' => rand(10,999),
		'estimated_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+1 year', $timezone = date_default_timezone_get()),
    ];
});

$factory->define(App\Payment::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,20),
		'value'=> $faker->randomNumber(),
		'user_id' => rand(1,20),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
	$strings = array(
		'aquaman.jpg',
		'arrow.jpg',
		'batman.jpg',
		'cyborg.jpg',
		'flash.jpg',
	);
	$key = array_rand($strings);
	$avatar = $strings[$key];
    return [
        'username' => $faker->word(),
		'email'=> $faker->safeEmail(),
		'password'=> bcrypt('123'),
		'public' => rand(0,1),
		'status' => 1,
		'role' => 2,
		'firstname' => $faker->firstName(),
		'lastname' => $faker->lastName(),
		'avatar' => $avatar,
		'bio' => $faker->text(),
    ];
});

$factory->define(App\Content::class, function (Faker\Generator $faker) {
    return [
		'category_id' => 2,
		'type'=> 2,
		'title' => $faker->text(30),
		'slug' => $faker->word(),
		'content' => $faker->text(),
		'status' => 'publish',
		'user_id' => 1,
		'showinfo' => rand(0,1),
    ];
});
