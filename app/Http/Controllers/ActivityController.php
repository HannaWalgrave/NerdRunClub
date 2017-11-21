<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Activity;
use App\NerdRunClub\Strava;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function chart()
    {
       $user = Auth::user();
        $currentGoal = $user->userScheduleDetail()->where('week', Carbon::now()->startOfWeek()->format('Y-m-d'))->first();



        return $currentGoal ;
    }
}
