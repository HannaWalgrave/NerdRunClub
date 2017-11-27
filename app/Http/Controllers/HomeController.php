<?php

namespace App\Http\Controllers;

use App\Schedule;
use Carbon\Carbon;
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
        $start_date_current_week = Carbon::now()->startOfWeek()->format('Y-m-d');
        $current_schedule_detail = $user->userScheduleDetail()->where('week', $start_date_current_week)->first();
        $this_weeks_message = $current_schedule_detail->message;

        return view('home', compact('user', 'schedule', 'this_weeks_message'));
    }
}
