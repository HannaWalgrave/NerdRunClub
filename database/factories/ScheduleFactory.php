<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'end_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '2018-06-30'),
        'distance_goal' => $faker->numberBetween($min = 1, $max = 99),
    ];
});



