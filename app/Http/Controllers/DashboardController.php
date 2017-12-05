<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $amount_zombies = User::where('schedule_id', $user->schedule_id)->where('zombie', 1)->count();
        $amount_humans = User::where('schedule_id', $user->schedule_id)->where('zombie', 0)->count();

        $km_zombies = number_format(DB::table('users')->join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $user->schedule_id)->where('users.zombie', 1)->sum('activities.distance') / 1000, 1, ",", ".");
        $km_humans = number_format(DB::table('users')->join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $user->schedule_id)->where('users.zombie', 0)->sum('activities.distance') / 1000, 1, ",", ".");

        $amount_activities = $user->activities()->count();
        $averageKm_user = 0;
        foreach ($user->activities as $activity) {
            $averageKm_user += ($activity->distance / 1000);
        }
        $averageKm_user = number_format($averageKm_user / $amount_activities, 1, ",", ".");
        $averageKm_all = number_format(DB::table('users')->join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $user->schedule_id)->avg('activities.distance') / 1000, 1, ",", ".");


        $currentGoal = $user->currentSchedule();
        $run_this_week = "0,0";
        if ($currentGoal != null) {
            $run_this_week = $user->runThisWeek();
            $currentGoal = number_format($currentGoal->km_this_week, 1, ",", ".");
        }

        $days_until_goal = Carbon::parse($user->schedule->end_date)->diffInDays(Carbon::now());

        return view('dashboard', compact('amount_zombies', 'amount_humans', 'km_zombies', 'km_humans', 'averageKm_user', 'averageKm_all', 'run_this_week', 'currentGoal', 'days_until_goal','user'));
    }

    public function chart(Request $request)
    {
        $result = [];

        $user = Auth::user();

        $amount_zombies = User::where('schedule_id', $user->schedule_id)->where('zombie', 1)->count();
        $amount_humans = User::where('schedule_id', $user->schedule_id)->where('zombie', 0)->count();
        array_push($result,$amount_humans,$amount_zombies);

        return $result;
    }

    public function chartOne(Request $request)
    {
        $result = [];

        $user = Auth::user();
        $km_zombies = DB::table('users')->join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $user->schedule_id)->where('users.zombie', 1)->sum('activities.distance') / 1000;
        $km_humans = DB::table('users')->join('activities', 'users.id', '=', 'activities.user_id')->where('users.schedule_id', $user->schedule_id)->where('users.zombie', 0)->sum('activities.distance') / 1000;

        array_push($result,$km_humans,$km_zombies);

        return $result;
    }

}