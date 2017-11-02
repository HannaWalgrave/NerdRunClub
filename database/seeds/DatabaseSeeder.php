<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $this->call(ScheduleSeeder::class);
        $this->call(ScheduleDataSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(UserDataSeeder::class);
        $this->call(ActivitySeeder::class);

    }
}
