<?php

use Faker\Generator as Faker;
use App\Schedule;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\ScheduleData::class, function (Faker $faker) {
    $schedule_id = $faker->randomElement(Schedule::pluck('id')->toArray());
    $schedule = Schedule::where('id',$schedule_id)->first();
    return [
        'schedule_id' => $schedule_id,
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'distance' => $faker->numberBetween(1,$schedule->distance_goal),
        'week' => $faker->numberBetween(1,$schedule->weeks),
        'day' => $faker->numberBetween(1,7)
    ];
});
