<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\YogaClass;
use Faker\Generator as Faker;

$factory->define(YogaClass::class, function (Faker $faker) {
    return [
        'date' => Carbon\Carbon::now()->format('Y-m-d'),
        'instructor' => $faker->name,
        'attendent' => $faker->randomNumber(2),
        'attendance' => '2020-09-01',
        'started_at' => $faker->time($format='H:i', $max='now'),
        'ended_at' => $faker->time($format='H:i', $max='now'),
        'notes' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});
