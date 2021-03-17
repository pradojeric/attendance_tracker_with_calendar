<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assessment;
use Faker\Generator as Faker;

$factory->define(Assessment::class, function (Faker $faker) {
    return [
        //
        'room_id' => rand(1,2),
        'title' => $faker->words(3, true),
        'description' => $faker->realText(100,2),
        'total' => 100,
        'deadline' => $faker->dateTimeBetween('-1 months', '3 months'),
        'created_at' => now(),
    ];
});
