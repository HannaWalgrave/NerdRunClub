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
    public function chart()
    {
        $user = auth()->user();
        $user->schedule();

        return
    }
}
