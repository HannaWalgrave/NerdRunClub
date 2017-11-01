<?php

use Illuminate\Database\Seeder;
use App\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(Schedule::class, 5)->create();

        // makes more sense to test with some fixed data on running schedule level

        $schedule1 = new Schedule();
        $schedule1['id'] = 1;
        $schedule1['name'] = "IMD 10 miles of wow!";
        $schedule1['weeks'] = 10;
        $schedule1['distance_goal'] = 16;
        $schedule1->save();

        $schedule2 = new Schedule();
        $schedule2['id'] = 2;
        $schedule2['name'] = "Iron Man Training Camp";
        $schedule2['weeks'] = 20;
        $schedule2['distance_goal'] = 44;
        $schedule2->save();

        $schedule3 = new Schedule();
        $schedule3['id'] = 3;
        $schedule3['name'] = "De KVLV Loopt Met U Mee";
        $schedule3['weeks'] = 4;
        $schedule3['distance_goal'] = 5;
        $schedule3->save();
    }
}

