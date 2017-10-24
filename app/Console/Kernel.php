<?php

namespace App\Console;

use App\NerdRunClub\Strava;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    // laadt om het uur (op het volle uur) de data van de actieve user in

    protected function schedule(Schedule $schedule)
    {

        $schedule->call('App\Http\Controllers\ActivityController@update')
                 ->everyMinute()
                 ->appendOutputTo('log/activitiesupdater.txt');

        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
