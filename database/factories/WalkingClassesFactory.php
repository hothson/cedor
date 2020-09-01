<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WalkingClass;
use Faker\Generator as Faker;

$factory->define(WalkingClass::class, function (Faker $faker) {
    return [
        'instructor' => $faker->name,
        'attendent' => $faker->randomNumber(2),
        'vitamin_D' => $faker->randomNumber(2),
        'started_at' => $faker->date($format = 'Y-m-d'),
        'ended_at' => $faker->date($format = 'Y-m-d'),
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
