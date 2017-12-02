<?php

use App\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserScheduleDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(User::all() as $user) {
            for($i = 1; $i <= $user->number_weeks; $i++) {
                factory(\App\UserScheduleDetail::class)->create([
                    'user_id' => $user->id,
                    'week' => Carbon::parse($user->start_date)->addweeks($i-1),
                    'week_count' => $i,
                    'km_this_week' => $user->km_per_week * $i,
                    'km_this_week_modified' => $user->km_per_week * $i,
                    'modified_marker' => false,
                    'goal_status' => "to do",
                ]);
            }
        }

    }
}
