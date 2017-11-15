<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /**
         * De code dat hier geschreven staat zorgt ervoor dat je enkel naar /schedules kan als je nog geen schedule gekozen hebt waardoor
         * het geen nut heeft om in de view een if else te zetten (schedule gekozen of niet)
         * Nu wordt je vanuit home naar hier geredirect als je nog geen schedule gekozen hebt, maar als je er wel al een hebt kan je hier wel nog op
         * zodat je dit later eventueel kan aanpassen.
         */


        /*$user = auth()->user();
        $user = User::find($user->id);  // Je overschrijft hier de user maar het resultaat bijft hetzelfde: auth()->user() geeft de hele user terug zoals het in de databank staat
        $schedule = $user['schedule_id'];
        $allSchedules = Schedule::all();
        $selectedSchedule = $user->schedule_id;

        // pass user and schedule data over to schedule view

        if ($selectedSchedule == 0) {
            return view('schedule', compact('user', 'schedule', 'allSchedules'));
        } else {
            return view('home', compact('user'));
        }*/

        $user = auth()->user();
        $schedules = Schedule::all();
        return view('schedule', compact('user', 'schedules'));
    }

    /*
    public function store(Request $request)
    {
        $schedule_id = $request->schedule;
        $schedule = Schedule::where('id', $schedule_id)->first();

        $user = auth()->user();
        $user->schedule_id = $schedule_id;
        $user->save();

        return redirect()->route('home');
    }
    */

    public function store_user_schedule(Request $request) {

        $user = auth()->user();

        $user_id = $user->id;

        $schedule_id = $request->input('schedule');
        $init_date = Carbon::now();

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



        $schedule_end_date_1 = Schedule::find($schedule_id)->end_date;
        $schedule_end_date = \DateTime::createFromFormat('Y-m-d', $schedule_end_date_1);

        $number_weeks = floor(($schedule_end_date->diff($start_date)->days)/7);

        $km_per_week = Schedule::find($schedule_id)->distance_goal / $number_weeks;

        $user_Schedule = new App\UserSchedule();
        $user_Schedule->user_id = $user_id;
        $user_Schedule->schedule_id = $schedule_id;
        $user_Schedule->init_date = $init_date;
        $user_Schedule->start_date = $start_date;
        $user_Schedule->number_weeks = $number_weeks;
        $user_Schedule->km_per_week = $km_per_week;
        $user_Schedule->save();

        return redirect()->route('home');

    }
}
