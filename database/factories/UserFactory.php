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

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\User::class, function (Faker $faker) {
    $schedule_id = $faker->randomElement(Schedule::pluck('id')->toArray());
    $schedule = Schedule::where('id', $schedule_id)->first();
    $init_date = $faker->dateTimeBetween('-30 days', 'today');
    $init_date = Carbon::parse($init_date->format('Y-m-d H:i:s'));

    switch ($init_date->dayOfWeek) {
        case Carbon::FRIDAY:
        case Carbon::SATURDAY:
        case Carbon::SUNDAY:
            $start_date = $init_date->startOfWeek()->addWeek();
            break;
        default:
            $start_date = $init_date->startOfWeek();
            break;
    }

    $number_weeks = floor(Carbon::parse($schedule->end_date)->DIFF($start_date)->days / 7);


    return [
        'strava_id' => $faker->randomNumber($nbDigits = 6),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'sex' => $faker->randomElement($array = array('M', 'F')),
        'profile' => $faker->imageUrl($width = 124, $height = 124),
        'token' => str_random(10),
        'schedule_id' => $schedule_id,
        'init_date' => $init_date,
        'start_date' => $start_date,
        'number_weeks' => $number_weeks,
        'km_per_week' => $schedule->distance_goal / $number_weeks,
    ];
});


