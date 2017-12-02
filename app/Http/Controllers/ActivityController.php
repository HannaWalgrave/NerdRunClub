<?php

namespace App\Http\Controllers;

use App;
use App\Schedule;
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
        $user_id = Auth::id();
        $result = [];
        $schedule = UserScheduleDetail::find($request->schedule_id);
        $start_last_week = Carbon::now()->startOfWeek()->subWeek();
        $end_last_week = Carbon::now()->startOfWeek()->subDay();
        $activities = Auth::user()->activities()->where('start_date', '>=', $start_last_week)->where('start_date', '<=', $end_last_week)->get();
        foreach ($activities as $activity) {
            $r = [];
            array_push($r, Carbon::parse($activity->start_date)->format('d/m/Y'));
            array_push($r, number_format($activity->distance / 1000, 1, ",", "."));
            array_push($result, $r);
        }

        return $result;
    }

    public function chart(Request $request)
    {
        $result = [];

        $user = auth()->user();
        $currentGoal = $user->userScheduleDetail()->where('week', Carbon::now()->startOfWeek()->format('Y-m-d'))->first();

        if ($currentGoal != null) {
            array_push($result, $currentGoal->km_this_week);
            $start_last_week = Carbon::now()->startOfWeek()->subWeek();
            $end_last_week = Carbon::now()->startOfWeek()->subDay();
            $kmRun = number_format(Auth::user()->activities()->where('start_date', '>=', $start_last_week)->where('start_date', '<=', $end_last_week)->sum('distance') / 1000, 1, ",", ".");
            array_push($result, $kmRun);
        }

        return $result;
    }
}
