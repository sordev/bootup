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
	
	$videoArray =[
		'https://www.youtube.com/watch?v=O22xhjJxWws',
		'https://www.youtube.com/watch?v=h8575UD8sNY',
		'https://www.youtube.com/watch?v=q2NU8y93SyA',
	];
	$key = array_rand($videoArray);
	$video = $videoArray[$key];

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
		'video' => $video,
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
	$values = ['0',$faker->randomNumber()];
	$key = array_rand($values);
	$value = $values[$key];
	
    return [
		'value'=> $value,
		'user_id' => rand(1,20),
		'status' => rand(0,1),
		//'reward_id' => factory(App\Reward::class)->create()->id,
		'note' => $faker->text(30),
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
        'username' => $faker->word().$faker->word(),
		'email'=> $faker->safeEmail(),
		'password'=> bcrypt('12345'),
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
		'category_id' => rand(6,15),
		'type'=> 2,
		'title' => $faker->text(30),
		'slug' => $faker->word().'-'.$faker->word().'-'.$faker->word(),
		'content' => $faker->text(),
		'status' => 'publish',
		'comments' => 1,
		'user_id' => 1,
		'showinfo' => rand(0,1),
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
		'title' => $faker->text(30),
		'type'=> 3,
		'slug' => $faker->word().'-'.$faker->word(),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
	$strings = array(
		null,
		1,
	);
	$key = array_rand($strings);
	$reply_id = $strings[$key];
    return [
		'comment' => $faker->text(),
		'reply_id' => $reply_id,
		'user_id' => rand(1,20),
		'status' => 1,
    ];
});
