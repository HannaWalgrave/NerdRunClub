<?php

namespace App\Http\Controllers;

use App;
use App\User;
use App\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $user = auth()->user();
        $user = User::find($user->id);
        $schedule = $user['schedule_id'];
        $allSchedules = Schedule::all();

        // pass user and schedule data over to schedule view
        return view('schedule', compact('user', 'schedule', 'allSchedules'));
    }

    public function store(Request $request) {
        echo "nu zou er gesaved moeten worden";
        $schedule_id = $request->schedule;
        echo $schedule_id;
        $user = auth()->user();
        var_dump($user);
        $user->schedule_id = $schedule_id;
        $user->save();


    }
}
