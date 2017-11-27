<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\UserScheduleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Door deze middleware toe te voegen kan je enkel op home als je al een schedule gekozen hebt. Anders wordt je geredirect naar /schedule
        $this->middleware('schedule');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $schedule = Schedule::all()->where('id', $user->schedule_id);
        $this_weeks_userSchedule = UserScheduleDetail::all()->where('user_id', $user->id)->first();
        $this_weeks_message = $this_weeks_userSchedule->message;

        return view('home', compact('user', 'schedule', 'this_weeks_message'));
    }
}
