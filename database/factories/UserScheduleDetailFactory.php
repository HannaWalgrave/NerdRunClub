<?php

use App\User;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\UserScheduleDetail::class, function (Faker $faker) {
    $user_id = $faker->randomElement(User::pluck('id')->toArray());
    $user = User::where('id',$user_id)->first();


    return [
        'user_id' => $faker->randomNumber(),
        'week' => $faker->date(),
        'week_count' => $faker->randomNumber(),
        'km_this_week_modified' => $faker->randomFloat(),
        'km_this_week' => $faker->randomFloat(),
        'modified_marker' => false
    ];
});