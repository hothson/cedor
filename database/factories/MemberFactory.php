<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'account_number' => $faker->unique()->randomNumber(6),
        'name' => $faker->name,
        'age' => $faker->randomNumber(2),
        'gender' => 'Male',
        'phone_number' => $faker->phoneNumber,
    ];
});
