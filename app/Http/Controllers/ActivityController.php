<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Activity;
use App\UserScheduleDetail;
use App\NerdRunClub\Strava;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index(Request $request)
    {
        $schedule = UserScheduleDetail::find($request->schedule_id);
        $activities = Activity::where('start_date', '>=', $schedule->week)->where('start_date', '<=', Carbon::parse($schedule->week)->addDays(6))->get();
        return $activities;
    }

    public function chart()
    {
       $user = Auth::user();
        $currentGoal = $user->userScheduleDetail()->where('week', Carbon::now()->startOfWeek()->format('Y-m-d'))->first();



        return $currentGoal ;
    }
}
