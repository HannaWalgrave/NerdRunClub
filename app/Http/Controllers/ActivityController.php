<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Activity;
use App\NerdRunClub\Strava;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        //get active user and collect all activities from database
        $user = auth()->user();
        $currentGoal = $user->userScheduleDetail()->where('week', Carbon::now()->startOfWeek()->format('Y-m-d'))->first();
        $nextGoals = $user->userScheduleDetail()->where('week', '>', Carbon::now()->startOfWeek()->format('Y-m-d'))->get();
        $activities = $user->activities;

        // pass user and activities data over to activities view
        return view('activities', compact('user', 'currentGoal', 'nextGoals', 'activities'));
    }
}
