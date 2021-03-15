<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Assignment;
use Faker\Generator as Faker;

$factory->define(Assignment::class, function (Faker $faker) {
    return [
        //
        'title' => $faker->word,
        'description' => $faker->realText(100),
        'deadline' => $faker->dateTimeBetween('now', '3 months'),
        'created_at' => now(),
    ];
});
