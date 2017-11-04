<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
        'strava_activity_id' => $faker->randomNumber($nbDigits = 6),
        'user_id' => $faker->randomElement(User::pluck('id')->toArray()),
        'distance' => $faker->randomFloat($nbMaxDecimals = 1, $min = 0, $max = 10000),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
    ];

});
