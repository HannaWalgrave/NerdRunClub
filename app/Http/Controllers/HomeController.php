<?php

namespace App\Http\Controllers;

use App\Schedule;
use App\UserSchedule;
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
        $this->middleware('auth');

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
        $user_id = Auth::id();
        $user_schedule = UserSchedule::search()->where('user_id', $user_id)->get();
        $schedule_id = $user_schedule->schedule_id;
        $schedule = Schedule::all()->where('id', $schedule_id);

        return view('home', compact('user', 'schedule'));
    }
}
