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

    if ($init_date->dayOfWeek == Carbon::MONDAY) {
        $start_date = Carbon::now();
    } elseif ($init_date->dayOfWeek == Carbon::TUESDAY) {
        $start_date = Carbon::now()->subDay();
    } elseif ($init_date->dayOfWeek == Carbon::WEDNESDAY) {
        $start_date = Carbon::now()->subDays(2);
    } elseif ($init_date->dayOfWeek == Carbon::THURSDAY) {
        $start_date = Carbon::now()->subDays(3);
    } elseif ($init_date->dayOfWeek == Carbon::FRIDAY) {
        $start_date = Carbon::now()->addDays(3);
    } elseif ($init_date->dayOfWeek == Carbon::SATURDAY) {
        $start_date = Carbon::now()->addDays(2);
    } elseif ($init_date->dayOfWeek == Carbon::SUNDAY) {
        $start_date = Carbon::now()->addDay();
    } else {
        $start_date = "ERROR";
    }

    $number_weeks = floor(Carbon::parse($schedule->end_date)->DIFF($start_date)->days / 7);


    return [
        'strava_id' => $faker->randomNumber($nbDigits = 6),
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'sex' => $faker->randomElement($array = array('M', 'F')),
        'profile' => $faker->imageUrl($width = 124, $height = 124),
        'token' => "f798846a2ce4f6a7a31faf101972935eba245750",
        'schedule_id' => $schedule_id,
        'init_date' => $init_date,
        'start_date' => $start_date,
        'number_weeks' => $number_weeks,
        'km_per_week' => $schedule->distance_goal / $number_weeks,
        'zombie' => $faker->boolean()
    ];
});


