<?php

use App\User;
use App\ScheduleData;
use Carbon\Carbon;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\UserData::class, function (Faker $faker) {

    $user_id = $faker->randomElement(User::pluck('id')->toArray());
    $user = User::where('id',$user_id)->first();

    $scheduleData_id = $faker->randomElement(ScheduleData::where('schedule_id', $user->schedule->id)->get()->toArray());
    $scheduleData = ScheduleData::where('id', $scheduleData_id)->first();
    $date = Carbon::parse($user->schedule_start)->addDays(($scheduleData->day -1) + 7*($scheduleData->week -1));

    return [
        'user_id' => $user_id,
        'scheduleData_id' => $scheduleData,
        'date' => $date
    ];
});
