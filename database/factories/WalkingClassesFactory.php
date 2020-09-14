<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WalkingClass;
use Faker\Generator as Faker;

$factory->define(WalkingClass::class, function (Faker $faker) {
    return [
        'instructor' => $faker->name,
        'attendent' => $faker->randomNumber(2),
        'attendance' => '2020-09-01',
        'vitamin_D' => $faker->randomNumber(2),
        'started_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'ended_at' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
