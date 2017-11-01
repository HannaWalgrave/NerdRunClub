<?php

use Illuminate\Database\Seeder;
use App\ScheduleData;

class ScheduleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "First run!";
        $data['distance'] = 3;
        $data['week'] = 1;
        $data['day'] = 2;
        $data->save();

        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "second run!";
        $data['distance'] = 3;
        $data['week'] = 1;
        $data['day'] = 4;
        $data->save();

        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "Finish your first week";
        $data['distance'] = 3;
        $data['week'] = 1;
        $data['day'] = 6;
        $data->save();

        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "Don't give up now";
        $data['distance'] = 5;
        $data['week'] = 2;
        $data['day'] = 2;
        $data->save();

        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "You can do it!";
        $data['distance'] = 3;
        $data['week'] = 2;
        $data['day'] = 4;
        $data->save();

        $data = new ScheduleData();
        $data['schedule_id'] = 1;
        $data['title'] = "Don't let the zombies catch you";
        $data['distance'] = 5;
        $data['week'] = 2;
        $data['day'] = 6;
        $data->save();
    }
}