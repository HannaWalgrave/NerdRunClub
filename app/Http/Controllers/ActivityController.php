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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //get active user and collect all activities from database
        $user = auth()->user();
        $user = User::find($user->id);
        $activities = $user->activities;


        // pass user and activities data over to activities view
        return view('activities', compact('user', 'activities'));
    }
}
