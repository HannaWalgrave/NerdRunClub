<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
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

    public function store(Request $request) {
        $schedule_id = $request->schedule;
        $user = auth()->user();
        $user->schedule_id = $schedule_id;
        $user->save();

        return redirect()->route('home');
    }
}
