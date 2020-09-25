<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WalkingClass;
use Faker\Generator as Faker;

$factory->define(WalkingClass::class, function (Faker $faker) {
    return [
        'date' => Carbon\Carbon::now()->format('Y-m-d'),
        'instructor' => $faker->name,
        'attendent' => $faker->randomNumber(2),
        'vitamin_D' => $faker->randomNumber(2),
        'started_at' => $faker->time($format='H:i', $max='now'),
        'ended_at' => $faker->time($format='H:i', $max='now'),
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
