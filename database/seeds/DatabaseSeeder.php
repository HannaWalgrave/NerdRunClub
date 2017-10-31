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
        $this->call(UserSeeder::class);
        $this->call(ActivitySeeder::class);
        // de schedule seeder werkt prima, maar ik laat deze liever inactief zodat ik met manuele voorbeelden kan werken
        // $this->call(ScheduleSeeder::class);
    }
}
