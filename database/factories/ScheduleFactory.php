<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'weeks' => $faker->numberBetween($min = 1, $max = 20),
        'distance_goal' => $faker->numberBetween($min = 1, $max = 99),
    ];
});



