<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\NerdRunClub\Strava;
use App\User;
use App\Activity;
use Carbon\Carbon;

class dbUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Strava user and activity data in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Strava $strava)
    {
        // message for log file  (storage/logs/laravel.log)
        \Log::info('This is a database update which happened at ' . Carbon::now());

        // collect all users from database, loop over them and for each of them retrieve all activities from Strava API
        // existing activities will remain in the database, new activities will be added

        $allUsers = User::all();

        foreach ($allUsers as $user) {

            $data = $strava->get('/api/v3/athlete/activities', ['Authorization' => 'Bearer ' . $user->token]);

            foreach ($data as $activity) {
                if ($activity->type == "Run" && $activity->max_speed > 0) {
                    $newActivity = Activity::firstOrNew(['strava_activity_id' => $activity->id]);
                    $newActivity->strava_activity_id = $activity->id;
                    $newActivity->user_id = $user->id;
                    $newActivity->distance = $activity->distance;
                    $newActivity->start_date = Carbon::parse($activity->start_date)->toDateTimeString();
                    $newActivity->save();
                }
            }
        }


    }
}
