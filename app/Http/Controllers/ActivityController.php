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
        $schedule = UserScheduleDetail::find($request->schedule_detail_id);
        $activities = Activity::where('start_date', '>=', $schedule->week)->where('start_date', '<=', Carbon::parse($schedule->week)->addDays(6))->where('user_id', '=', $user_id)->get();
        foreach($activities as $activity) {
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
        $currentGoal = $user->currentSchedule();

        if ($currentGoal != null) {
            array_push($result, $currentGoal->km_this_week_modified);
            array_push($result, $user->runThisWeek());
        }

        return $result;
    }
}
