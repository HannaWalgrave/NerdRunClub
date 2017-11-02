<?php

use Faker\Generator as Faker;
use App\Schedule;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $schedule_id = $faker->randomElement(Schedule::pluck('id')->toArray());
    $schedule = Schedule::where('id', $schedule_id)->first();
    $schedule_start = $faker->dateTimeBetween('this week', '+6 days');
    $schedule_end = Carbon::parse($schedule_start->format('Y-m-d H:i:s'))->addWeeks($schedule->weeks);

    return [
        'strava_id' => $faker->randomNumber($nbDigits = 6),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'sex' => $faker->randomElement($array = array ('M','F')),
        'profile' => $faker->imageUrl($width = 124, $height = 124),
        'token' => str_random(10),
        'schedule_id' => $schedule_id,
        'schedule_start' => $schedule_start,
        'schedule_end' => $schedule_end
    ];
});


