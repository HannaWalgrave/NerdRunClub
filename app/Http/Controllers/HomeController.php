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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $currentSchedule = $user->currentSchedule();
        $days_until_goal = Carbon::parse($user->schedule->end_date)->diffInDays(Carbon::now());
        $weeks_until_goal = Carbon::parse($user->schedule->start_date)->diffInWeeks(Carbon::now())+1;
        $this_weeks_message = "Let's run! Reach each week's goal or you will become a zombie!";
        if ($currentSchedule != null && $currentSchedule->week_count > 1) {
            if ($user->zombie) {
                $this_weeks_message = "You did not reach last week's goal, so you will have to run more in order to become human again!";
            } else {
                $this_weeks_message = "You managed to reach last week's goal, oh human! Keep going & make sure not to turn into a zombie!";
            }
        }

        return view('home', compact('user', 'schedule', 'current_schedule_detail', 'this_weeks_message','days_until_goal','weeks_until_goal'));
    }
}
