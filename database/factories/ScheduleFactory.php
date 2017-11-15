<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'end_date' => $faker->date(),
        'distance_goal' => $faker->numberBetween($min = 1, $max = 99),
    ];
});



